<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_login();

if ($_SESSION['school_user']['role_slug'] !== 'student') {
    json_response('error', 'Only students can access results');
}

$student = fetch_row('SELECT id FROM students WHERE user_id = ?', [$_SESSION['school_user']['id']], 'i');
if (!$student) {
    json_response('error', 'Student profile not found');
}

$rows = fetch_all('SELECT s.student_name, sub.subject_name, m.total_marks, m.grade FROM marks m JOIN subjects sub ON sub.id=m.subject_id JOIN students s ON s.id=m.student_id WHERE m.student_id = ? ORDER BY sub.subject_name', [$student['id']], 'i');
json_response('success', 'Student results fetched', ['results' => $rows]);
