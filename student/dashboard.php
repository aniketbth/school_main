<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_login();
require_role(['student']);

$pageTitle = 'Student Dashboard';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_student.php'; ?>
    <div class="content-panel">
        <h2>Student Dashboard</h2>
        <div class="row g-3 mt-3">
            <div class="col-md-4"><div class="glass-card p-4"><h5>Profile</h5><p class="text-muted mb-0">Update details and documents</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Results</h5><p class="text-muted mb-0">View report cards and grades</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Fees</h5><p class="text-muted mb-0">Check dues and receipts</p></div></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
