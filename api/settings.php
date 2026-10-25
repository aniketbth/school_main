<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response('error', 'Invalid request');
}

if (!verify_csrf($_POST['csrf_token'] ?? '')) {
    json_response('error', 'CSRF validation failed');
}

if (!isset($_POST['name']) || !isset($_POST['value'])) {
    json_response('error', 'Invalid form data');
}

foreach ($_POST['name'] as $key => $keyName) {
    $value = $_POST['value'][$key] ?? '';
    $stmt = query('INSERT INTO school_settings (key_name, key_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE key_value = VALUES(key_value)', [$keyName, $value], 'ss');
    $stmt->close();
}
json_response('success', 'Settings updated successfully.');
