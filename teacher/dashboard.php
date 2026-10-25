<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_login();
require_role(['teacher']);

$pageTitle = 'Teacher Dashboard';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_teacher.php'; ?>
    <div class="content-panel">
        <h2>Teacher Dashboard</h2>
        <div class="row g-3 mt-3">
            <div class="col-md-4"><div class="glass-card p-4"><h5>Attendance</h5><p class="text-muted mb-0">Live class attendance</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Marks Entry</h5><p class="text-muted mb-0">AJAX-based marks updates</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Homework</h5><p class="text-muted mb-0">Review submissions and feedback</p></div></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
