<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/functions.php';

if (!is_logged_in()) {
    redirect('/login.php');
}

$pageTitle = 'Leave Requests';
include __DIR__ . '/../includes/header.php';
$records = fetch_all('SELECT * FROM leave_requests ORDER BY created_at DESC LIMIT 20');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_teacher.php'; ?>
    <div class="content-panel">
        <h2>Leave Requests</h2>
        <div class="glass-card p-4 mt-3">
            <table class="table align-middle">
                <thead><tr><th>User</th><th>From</th><th>To</th><th>Status</th></tr></thead>
                <tbody>
                    <?php foreach ($records as $r): ?>
                    <tr>
                        <td><?= e($r['user_id']) ?></td>
                        <td><?= e($r['start_date']) ?></td>
                        <td><?= e($r['end_date']) ?></td>
                        <td><?= e($r['status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
