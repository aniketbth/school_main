<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_login();
require_role(['receptionist']);

$pageTitle = 'Receptionist Dashboard';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_receptionist.php'; ?>
    <div class="content-panel">
        <h2>Reception Dashboard</h2>
        <div class="row g-3 mt-3">
            <div class="col-md-4"><div class="glass-card p-4"><h5>Enquiries</h5><p class="text-muted mb-0">Admission and contact requests</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Visitors</h5><p class="text-muted mb-0">Record guest visits</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Call Log</h5><p class="text-muted mb-0">Recent calls and follow-ups</p></div></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
