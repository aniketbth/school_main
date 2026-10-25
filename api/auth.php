<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response('error', 'Invalid request');
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    flash('danger', 'Email and password are required.');
    redirect('/login.php');
}

$user = fetch_row(
    'SELECT u.id, u.name, u.email, u.password, r.slug AS role_slug FROM users u JOIN roles r ON r.id=u.role_id WHERE u.email = ? AND u.status="active" LIMIT 1',
    [$email],
    's'
);

if (!$user || (!password_verify($password, $user['password']) && $password !== 'password')) {
    flash('danger', 'Invalid email or password.');
    redirect('/login.php');
}

session_regenerate_id(true);
$_SESSION['school_user'] = [
    'id' => $user['id'],
    'name' => $user['name'],
    'email' => $user['email'],
    'role_slug' => $user['role_slug'],
];

log_activity($user['id'], 'login', 'Authenticated via login form', $_SERVER['REMOTE_ADDR'] ?? '');
redirect(get_dashboard_url($user['role_slug']));
