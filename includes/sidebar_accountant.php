<?php
require_once __DIR__ . '/auth_check.php';
?>
<aside class="sidebar glass-card">
    <div class="fw-bold mb-3">Parent</div>
    <nav class="nav flex-column gap-2">
        <a class="nav-link active" href="/parent/dashboard.php"><i class="bi bi-house"></i> Dashboard</a>
        <a class="nav-link" href="/parent/attendance.php"><i class="bi bi-calendar3"></i> Attendance</a>
        <a class="nav-link" href="/parent/fees.php"><i class="bi bi-wallet2"></i> Fees</a>
        <a class="nav-link" href="/parent/messages.php"><i class="bi bi-chat-left-text"></i> Messages</a>
    </nav>
</aside>
