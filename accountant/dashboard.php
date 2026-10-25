<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/functions.php';

if (!is_logged_in()) {
    redirect('/login.php');
}

$pageTitle = 'Finance';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_accountant.php'; ?>
    <div class="content-panel">
        <h2>Finance Dashboard</h2>
        <div class="row g-3 mt-2">
            <div class="col-md-4"><div class="glass-card p-4"><h5>Collected</h5><p class="text-muted mb-0">₹84,000</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Pending</h5><p class="text-muted mb-0">₹18,500</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Expenses</h5><p class="text-muted mb-0">₹24,000</p></div></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
