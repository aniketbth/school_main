<?php
require_once __DIR__ . '/auth_check.php';
?>
<aside class="sidebar glass-card">
    <div class="fw-bold mb-3">Librarian</div>
    <nav class="nav flex-column gap-2">
        <a class="nav-link active" href="/librarian/dashboard.php"><i class="bi bi-book"></i> Dashboard</a>
        <a class="nav-link" href="/librarian/books.php"><i class="bi bi-journal-bookmark"></i> Books</a>
        <a class="nav-link" href="/librarian/issues.php"><i class="bi bi-arrow-left-right"></i> Issues</a>
        <a class="nav-link" href="/librarian/reports.php"><i class="bi bi-bar-chart"></i> Reports</a>
    </nav>
</aside>
