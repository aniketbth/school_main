<?php
require_once __DIR__ . '/auth_check.php';
?>
<aside class="sidebar glass-card">
    <div class="fw-bold mb-3">Student</div>
    <nav class="nav flex-column gap-2">
        <a class="nav-link active" href="/student/dashboard.php"><i class="bi bi-house"></i> Dashboard</a>
        <a class="nav-link" href="/student/results.php"><i class="bi bi-clipboard2-data"></i> Results</a>
        <a class="nav-link" href="/student/fees.php"><i class="bi bi-wallet2"></i> Fees</a>
        <a class="nav-link" href="/student/homework.php"><i class="bi bi-journal-text"></i> Homework</a>
        <a class="nav-link" href="/student/messages.php"><i class="bi bi-chat-left-text"></i> Messages</a>
    </nav>
</aside>
