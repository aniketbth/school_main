<?php
session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';
require_login();
require_role(['super_admin','admin']);

$pageTitle = 'Admin Dashboard';
include __DIR__ . '/includes/header.php';
$stats = getSchoolStats();
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_admin.php'; ?>
    <div class="content-panel">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Admin Dashboard</h2>
            <button class="btn btn-primary">Quick Actions</button>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-md-3"><div class="glass-card p-4"><div class="small text-muted">Students</div><h3><?= $stats['students'] ?></h3></div></div>
            <div class="col-md-3"><div class="glass-card p-4"><div class="small text-muted">Teachers</div><h3><?= $stats['teachers'] ?></h3></div></div>
            <div class="col-md-3"><div class="glass-card p-4"><div class="small text-muted">Staff</div><h3><?= $stats['staff'] ?></h3></div></div>
            <div class="col-md-3"><div class="glass-card p-4"><div class="small text-muted">Notices</div><h3><?= $stats['notices'] ?></h3></div></div>
        </div>
        <div class="glass-card p-4">
            <h5>Recent Activity</h5>
            <table class="table table-borderless align-middle mb-0">
                <tbody>
                    <?php
                    $logs = fetch_all('SELECT a.action, a.created_at, u.name FROM activity_logs a LEFT JOIN users u ON u.id=a.user_id ORDER BY a.created_at DESC LIMIT 5');
                    foreach ($logs as $log):
                    ?>
                    <tr><td><?= e($log['action']) ?></td><td><?= e($log['name'] ?? 'System') ?></td><td><?= e($log['created_at']) ?></td></tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
