<?php
require_once __DIR__ . '/../config/db.php';

function redirect($location) {
    header('Location: ' . $location);
    exit;
}

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function is_logged_in() {
    return !empty($_SESSION['school_user']);
}

function current_user() {
    return $_SESSION['school_user'] ?? null;
}

function require_login() {
    if (!is_logged_in()) {
        redirect('/login.php');
    }
}

function user_role() {
    return $_SESSION['school_user']['role_slug'] ?? null;
}

function require_role($allowed = []) {
    require_login();
    $role = user_role();
    if (!in_array($role, (array) $allowed, true)) {
        redirect('/403.php');
    }
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

function flash($type, $message) {
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
}

function render_flash() {
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $item) {
            $type = $item['type'];
            $message = e($item['message']);
            echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
        unset($_SESSION['flash']);
    }
}

function json_response($status, $message = '', $data = []) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ]);
    exit;
}

function log_activity($userId, $action, $details = '', $ip = '') {
    $stmt = query(
        'INSERT INTO activity_logs (user_id, action, details, ip_address) VALUES (?, ?, ?, ?)',
        [$userId, $action, $details, $ip],
        'isss'
    );
    $stmt->close();
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
    return $map[$role] ?? '/dashboard.php';
}

function upload_file($fieldName, $targetDir = 'uploads', $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx']) {
    if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $file = $_FILES[$fieldName];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExtensions, true)) {
        return null;
    }

    if ($file['size'] > 5 * 1024 * 1024) {
        return null;
    }

    $destinationDir = __DIR__ . '/../' . ltrim($targetDir, '/');
    if (!is_dir($destinationDir)) {
        mkdir($destinationDir, 0777, true);
    }

    $newName = uniqid('file_', true) . '.' . $ext;
    $targetPath = $destinationDir . '/' . $newName;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        return null;
    }

    return $targetDir . '/' . $newName;
}

function fetch_row($sql, $params = [], $types = '') {
    $stmt = query($sql, $params, $types);
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row;
}

function fetch_all($sql, $params = [], $types = '') {
    $stmt = query($sql, $params, $types);
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $rows;
}

function get_setting($key, $default = '') {
    $row = fetch_row('SELECT key_value FROM school_settings WHERE key_name = ?', [$key], 's');
    return $row['key_value'] ?? $default;
}

function count_rows($table, $where = '', $params = [], $types = '') {
    $sql = 'SELECT COUNT(*) AS total FROM ' . $table;
    if ($where) {
        $sql .= ' WHERE ' . $where;
    }
    $row = fetch_row($sql, $params, $types);
    return (int) ($row['total'] ?? 0);
}

function getSchoolStats() {
    return [
        'students' => count_rows('students'),
        'teachers' => count_rows('teachers'),
        'staff' => count_rows('staff'),
        'notices' => count_rows('notices'),
    ];
}
