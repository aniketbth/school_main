<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? '')) {
        json_response('error', 'CSRF validation failed');
    }
}

header('Content-Type: application/json');
$data = [
    'notifications' => [
        ['title' => 'Welcome back', 'body' => 'Your dashboard is ready.'],
        ['title' => 'Fee reminder', 'body' => 'Class 6 fee due in 3 days.'],
    ]
];
json_response('success', 'Notifications loaded', $data);
