<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) {
    json_response('error', 'Authentication required');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response('error', 'Invalid request method');
}

$studentId = (int) ($_POST['student_id'] ?? 0);
$status = trim($_POST['status'] ?? 'present');

if ($studentId <= 0) {
    json_response('error', 'Student ID required');
}

$stmt = query('INSERT INTO attendance_students (student_id, attendance_date, status) VALUES (?, CURDATE(), ?) ON DUPLICATE KEY UPDATE status = VALUES(status)', [$studentId, $status], 'is');
$stmt->close();

json_response('success', 'Attendance updated', ['status' => $status]);
