<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'school_main';

if (!isset($conn) || !($conn instanceof mysqli)) {
    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        http_response_code(500);
        die('Database connection failed: ' . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');
}

function db() {
    global $conn;
    return $conn;
}

function query($sql, $params = [], $types = '') {
    $stmt = db()->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . db()->error);
    }

    if (!empty($params)) {
        if ($types === '') {
            $types = str_repeat('s', count($params));
        }
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    return $stmt;
}

function fetch_all($sql, $params = [], $types = '') {
    $stmt = query($sql, $params, $types);
    $result = $stmt->get_result();
    $rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    $stmt->close();
    return $rows;
}

function fetch_row($sql, $params = [], $types = '') {
    $stmt = query($sql, $params, $types);
    $result = $stmt->get_result();
    $row = $result ? $result->fetch_assoc() : null;
    $stmt->close();
    return $row;
}

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect($path) {
    header('Location: ' . $path);
    exit;
}

function is_logged_in() {
    return !empty($_SESSION['school_user']['id']);
}

function user_role() {
    return $_SESSION['school_user']['role_slug'] ?? null;
}

function require_login() {
    if (!is_logged_in()) {
        redirect('/login.php');
    }
}

function require_role($roles) {
    $allowed = is_array($roles) ? $roles : [$roles];
    if (!is_logged_in() || !in_array(user_role(), $allowed, true)) {
        redirect('/403.php');
    }
}

function flash($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function render_flash() {
    if (empty($_SESSION['flash'])) {
        return;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    $class = 'alert-info';
    if ($flash['type'] === 'success') {
        $class = 'alert-success';
    } elseif ($flash['type'] === 'danger') {
        $class = 'alert-danger';
    } elseif ($flash['type'] === 'warning') {
        $class = 'alert-warning';
    }

    echo '<div class="alert ' . $class . ' alert-dismissible fade show" role="alert">'
        . e($flash['message'])
        . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
        . '</div>';
}

function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function verify_csrf($token) {
    return hash_equals($_SESSION['csrf_token'] ?? '', (string) $token);
}

function json_response($status, $message, $payload = []) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $payload,
    ]);
    exit;
}

function get_setting($key, $default = '') {
    $row = fetch_row('SELECT key_value FROM school_settings WHERE key_name = ? LIMIT 1', [$key], 's');
    return $row['key_value'] ?? $default;
}

function set_setting($key, $value) {
    return query(
        'INSERT INTO school_settings (key_name, key_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE key_value = VALUES(key_value)',
        [$key, $value],
        'ss'
    );
}

function log_activity($userId, $action, $details = '', $ip = '') {
    try {
        query(
            'INSERT INTO activity_logs (user_id, action, details, ip_address, created_at) VALUES (?, ?, ?, ?, NOW())',
            [$userId, $action, $details, $ip],
            'isss'
        );
    } catch (Exception $e) {
        // Ignore if the logs table does not exist yet.
    }
}

function get_dashboard_url($role) {
    $map = [
        'super_admin' => '/admin/dashboard.php',
        'admin' => '/admin/dashboard.php',
        'principal' => '/principal/dashboard.php',
        'teacher' => '/teacher/dashboard.php',
        'student' => '/student/dashboard.php',
        'parent' => '/parent/dashboard.php',
        'accountant' => '/accountant/dashboard.php',
        'librarian' => '/librarian/dashboard.php',
        'receptionist' => '/receptionist/dashboard.php',
    ];
    return $map[$role] ?? '/index.php';
}

function getSchoolStats() {
    $stats = [
        'students' => 0,
        'teachers' => 0,
        'staff' => 0,
        'notices' => 0,
    ];

    try {
        $stats['students'] = (int) fetch_row('SELECT COUNT(*) AS total FROM students')['total'];
    } catch (Exception $e) {}

    try {
        $stats['teachers'] = (int) fetch_row('SELECT COUNT(*) AS total FROM teachers')['total'];
    } catch (Exception $e) {}

    try {
        $stats['staff'] = (int) fetch_row('SELECT COUNT(*) AS total FROM staff')['total'];
    } catch (Exception $e) {}

    try {
        $stats['notices'] = (int) fetch_row('SELECT COUNT(*) AS total FROM notices')['total'];
    } catch (Exception $e) {}

    return $stats;
}
