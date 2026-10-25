<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['receptionist'], true)) redirect('/403.php');

$pageTitle = 'Enquiries';
include __DIR__ . '/../includes/header.php';
$rows = fetch_all('SELECT * FROM enquiries ORDER BY created_at DESC LIMIT 20');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_receptionist.php'; ?>
    <div class="content-panel">
        <h2>Enquiries</h2>
        <div class="glass-card p-4 mt-3">
            <table class="table align-middle">
                <thead><tr><th>Name</th><th>Phone</th><th>Subject</th><th>Status</th></tr></thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= e($row['name']) ?></td>
                        <td><?= e($row['phone'] ?? '-') ?></td>
                        <td><?= e($row['subject'] ?? '-') ?></td>
                        <td><span class="badge text-bg-info"><?= e($row['status']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
