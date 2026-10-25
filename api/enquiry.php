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

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$subject = trim($_POST['subject'] ?? 'Website enquiry');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $message === '') {
    json_response('error', 'Name and message are required');
}

$stmt = query('INSERT INTO enquiries (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)', [$name, $email, $phone, $subject, $message], 'sssss');
$stmt->close();
json_response('success', 'Your enquiry has been submitted.', ['name' => $name]);
