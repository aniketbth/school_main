<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_login();
require_role(['parent']);

$pageTitle = 'Parent Dashboard';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_parent.php'; ?>
    <div class="content-panel">
        <h2>Parent Dashboard</h2>
        <div class="row g-3 mt-3">
            <div class="col-md-4"><div class="glass-card p-4"><h5>Child Performance</h5><p class="text-muted mb-0">Marks and homework updates</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Fees</h5><p class="text-muted mb-0">Dues and payment status</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Messages</h5><p class="text-muted mb-0">School communication</p></div></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
