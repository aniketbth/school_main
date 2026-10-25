<?php
require_once __DIR__ . '/auth_check.php';
?>
<aside class="sidebar glass-card">
    <div class="fw-bold mb-3">Teacher</div>
    <nav class="nav flex-column gap-2">
        <a class="nav-link active" href="/teacher/dashboard.php"><i class="bi bi-house"></i> Home</a>
        <a class="nav-link" href="/teacher/attendance.php"><i class="bi bi-calendar-check"></i> Attendance</a>
        <a class="nav-link" href="/teacher/marks.php"><i class="bi bi-clipboard-data"></i> Marks</a>
        <a class="nav-link" href="/teacher/homework.php"><i class="bi bi-mortarboard"></i> Homework</a>
        <a class="nav-link" href="/teacher/notices.php"><i class="bi bi-bell"></i> Notices</a>
    </nav>
</aside>
