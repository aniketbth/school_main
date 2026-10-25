<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/functions.php';

if (!is_logged_in()) {
    redirect('/login.php');
}

$pageTitle = 'Messages';
include __DIR__ . '/../includes/header.php';

$userId = $_SESSION['school_user']['id'];
$messages = fetch_all('SELECT m.*, u.name AS sender_name FROM messages m LEFT JOIN users u ON u.id=m.sender_id WHERE m.receiver_id=? ORDER BY sent_at DESC LIMIT 20', [$userId], 'i');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_student.php'; ?>
    <div class="content-panel">
        <h2>Inbox</h2>
        <div class="glass-card p-4 mt-3">
            <?php foreach ($messages as $msg): ?>
            <div class="border rounded-4 p-3 mb-3">
                <div class="d-flex justify-content-between">
                    <strong><?= e($msg['subject'] ?? 'No Subject') ?></strong>
                    <small class="text-muted"><?= e($msg['sent_at']) ?></small>
                </div>
                <div class="small text-muted mb-2">From: <?= e($msg['sender_name'] ?? 'System') ?></div>
                <p class="mb-0"><?= e($msg['message']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
