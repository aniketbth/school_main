<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/functions.php';

if (!is_logged_in()) {
    redirect('/login.php');
}

$pageTitle = 'Notices';
include __DIR__ . '/../includes/header.php';
$notices = fetch_all('SELECT * FROM notices ORDER BY published_at DESC LIMIT 10');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_admin.php'; ?>
    <div class="content-panel">
        <h2>Notice Board</h2>
        <div class="glass-card p-4 mt-3">
            <?php foreach ($notices as $notice): ?>
            <div class="border rounded-4 p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong><?= e($notice['title']) ?></strong>
                    <span class="badge text-bg-light"><?= e($notice['notice_type']) ?></span>
                </div>
                <p class="mb-0"><?= e($notice['content']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
