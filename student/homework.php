<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['student'], true)) redirect('/403.php');

$pageTitle = 'Homework';
include __DIR__ . '/../includes/header.php';
$rows = fetch_all('SELECT * FROM notices ORDER BY published_at DESC LIMIT 5');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_student.php'; ?>
    <div class="content-panel">
        <h2>Homework & Assignments</h2>
        <div class="glass-card p-4 mt-3">
            <ul class="list-group list-group-flush">
                <?php foreach ($rows as $row): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?= e($row['title']) ?></strong>
                        <div class="small text-muted"><?= e($row['content']) ?></div>
                    </div>
                    <span class="badge text-bg-light"><?= e($row['notice_type']) ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
