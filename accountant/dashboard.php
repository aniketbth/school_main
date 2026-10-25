<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_login();
require_role(['accountant']);

$pageTitle = 'Accountant Dashboard';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_accountant.php'; ?>
    <div class="content-panel">
        <h2>Accountant Dashboard</h2>
        <div class="row g-3 mt-3">
            <div class="col-md-4"><div class="glass-card p-4"><h5>Fee Collection</h5><p class="text-muted mb-0">Cash, UPI, cheque records</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Expenses</h5><p class="text-muted mb-0">School expenditure reports</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Ledger</h5><p class="text-muted mb-0">Bookkeeping overview</p></div></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
