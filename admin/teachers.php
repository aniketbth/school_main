<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['super_admin', 'admin'], true)) redirect('/403.php');

$pageTitle = 'Teachers';
include __DIR__ . '/../includes/header.php';
$rows = fetch_all('SELECT t.*, u.name, u.email FROM teachers t LEFT JOIN users u ON u.id=t.user_id ORDER BY t.id DESC LIMIT 20');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_admin.php'; ?>
    <div class="content-panel">
        <h2>Teachers</h2>
        <div class="glass-card p-4 mt-3">
            <table class="table align-middle">
                <thead>
                    <tr><th>Name</th><th>Employee Code</th><th>Designation</th><th>Email</th></tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= e($row['teacher_name']) ?></td>
                        <td><?= e($row['employee_code']) ?></td>
                        <td><?= e($row['designation']) ?></td>
                        <td><?= e($row['email'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
