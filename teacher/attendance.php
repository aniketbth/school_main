<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['teacher'], true)) redirect('/403.php');

$pageTitle = 'Teacher Attendance';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_teacher.php'; ?>
    <div class="content-panel">
        <h2>Live Attendance</h2>
        <div class="glass-card p-4 mt-3">
            <table class="table align-middle">
                <thead>
                    <tr><th>Student</th><th>Class</th><th>Present</th><th>Absent</th><th>Late</th></tr>
                </thead>
                <tbody>
                    <?php
                    $students = fetch_all('SELECT s.student_name, c.class_name FROM students s LEFT JOIN classes c ON c.id=s.class_id ORDER BY s.id DESC LIMIT 10');
                    foreach ($students as $student):
                    ?>
                    <tr>
                        <td><?= e($student['student_name']) ?></td>
                        <td><?= e($student['class_name'] ?? '-') ?></td>
                        <td><input type="radio" name="attendance_<?= e($student['student_name']) ?>" value="present" checked></td>
                        <td><input type="radio" name="attendance_<?= e($student['student_name']) ?>" value="absent"></td>
                        <td><input type="radio" name="attendance_<?= e($student['student_name']) ?>" value="late"></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
