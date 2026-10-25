<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['parent'], true)) redirect('/403.php');

$pageTitle = 'Parent Dashboard';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_parent.php'; ?>
    <div class="content-panel">
        <h2>Parent Dashboard</h2>
        <div class="row g-3 mt-2">
            <div class="col-md-4"><div class="glass-card p-4"><h5>Child Attendance</h5><p class="text-muted mb-0">96% this month</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Homework</h5><p class="text-muted mb-0">3 pending</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Fees</h5><p class="text-muted mb-0">₹2,500 due</p></div></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
