<?php
require_once __DIR__ . '/auth_check.php';
require_once __DIR__ . '/functions.php';
?>
<aside class="sidebar glass-card">
    <div class="fw-bold mb-3">Admin Panel</div>
    <nav class="nav flex-column gap-2">
        <a class="nav-link active" href="/admin/dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a class="nav-link" href="/admin/admissions.php"><i class="bi bi-person-plus"></i> Admissions</a>
        <a class="nav-link" href="/admin/students.php"><i class="bi bi-people"></i> Students</a>
        <a class="nav-link" href="/admin/teachers.php"><i class="bi bi-person-workspace"></i> Teachers</a>
        <a class="nav-link" href="/admin/fees.php"><i class="bi bi-currency-dollar"></i> Fees</a>
        <a class="nav-link" href="/admin/exams.php"><i class="bi bi-journal-check"></i> Exams</a>
        <a class="nav-link" href="/admin/library.php"><i class="bi bi-book"></i> Library</a>
        <a class="nav-link" href="/admin/notices.php"><i class="bi bi-megaphone"></i> Notices</a>
        <a class="nav-link" href="/admin/settings.php"><i class="bi bi-gear"></i> Settings</a>
    </nav>
</aside>
