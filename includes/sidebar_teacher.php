<?php
require_once __DIR__ . '/auth_check.php';
?>
<aside class="sidebar glass-card">
    <div class="fw-bold mb-3">Principal</div>
    <nav class="nav flex-column gap-2">
        <a class="nav-link active" href="/principal/dashboard.php"><i class="bi bi-speedometer2"></i> Overview</a>
        <a class="nav-link" href="/principal/approvals.php"><i class="bi bi-check2-square"></i> Approvals</a>
        <a class="nav-link" href="/principal/reports.php"><i class="bi bi-bar-chart"></i> Reports</a>
        <a class="nav-link" href="/principal/messages.php"><i class="bi bi-chat-dots"></i> Messages</a>
    </nav>
</aside>
