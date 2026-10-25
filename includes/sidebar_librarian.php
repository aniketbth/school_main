<?php
require_once __DIR__ . '/auth_check.php';
?>
<aside class="sidebar glass-card">
    <div class="fw-bold mb-3">Accountant</div>
    <nav class="nav flex-column gap-2">
        <a class="nav-link active" href="/accountant/dashboard.php"><i class="bi bi-currency-dollar"></i> Dashboard</a>
        <a class="nav-link" href="/accountant/fees.php"><i class="bi bi-wallet2"></i> Fees</a>
        <a class="nav-link" href="/accountant/expenses.php"><i class="bi bi-receipt"></i> Expenses</a>
        <a class="nav-link" href="/accountant/ledger.php"><i class="bi bi-book-half"></i> Ledger</a>
    </nav>
</aside>
