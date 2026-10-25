<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_login();
require_role(['librarian']);

$pageTitle = 'Librarian Dashboard';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_librarian.php'; ?>
    <div class="content-panel">
        <h2>Librarian Dashboard</h2>
        <div class="row g-3 mt-3">
            <div class="col-md-4"><div class="glass-card p-4"><h5>Books</h5><p class="text-muted mb-0">Catalog management</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Issue/Return</h5><p class="text-muted mb-0">Issue books to students</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Reports</h5><p class="text-muted mb-0">Fine and stock reports</p></div></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
