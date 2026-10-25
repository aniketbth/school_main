<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['principal'], true)) redirect('/403.php');

$pageTitle = 'Reports';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_principal.php'; ?>
    <div class="content-panel">
        <h2>School Reports</h2>
        <div class="row g-3 mt-2">
            <div class="col-md-4"><div class="glass-card p-4"><h5>Top Performers</h5><p class="text-muted mb-0">12 students above 90%</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Weak Students</h5><p class="text-muted mb-0">3 students need attention</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Attendance</h5><p class="text-muted mb-0">Average 92.4%</p></div></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
