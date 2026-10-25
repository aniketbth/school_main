<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_login();
require_role(['principal']);

$pageTitle = 'Principal Dashboard';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_principal.php'; ?>
    <div class="content-panel">
        <h2>Principal Dashboard</h2>
        <div class="row g-3 mt-3">
            <div class="col-md-4"><div class="glass-card p-4"><h5>Overall Performance</h5><p class="text-muted mb-0">School-wise analytics</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Approvals</h5><p class="text-muted mb-0">Admission and leave reviews</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Reports</h5><p class="text-muted mb-0">Top performers and weak areas</p></div></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
