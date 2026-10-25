<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/constants.php';

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'school_main';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

function db() {
    global $conn;
    return $conn;
}

function query($sql, $params = [], $types = '') {
    $stmt = db()->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . db()->error);
    }
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    return $stmt;
}
