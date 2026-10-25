<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['super_admin', 'admin', 'accountant'], true)) redirect('/403.php');

$pageTitle = 'Fees';
include __DIR__ . '/../includes/header.php';
$rows = fetch_all('SELECT f.*, s.student_name FROM fees f LEFT JOIN students s ON s.id=f.student_id ORDER BY f.id DESC LIMIT 20');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_admin.php'; ?>
    <div class="content-panel">
        <h2>Fee Records</h2>
        <div class="glass-card p-4 mt-3">
            <table class="table align-middle">
                <thead>
                    <tr><th>Student</th><th>Month</th><th>Amount</th><th>Status</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= e($row['student_name'] ?? '-') ?></td>
                        <td><?= e($row['fee_month']) ?></td>
                        <td><?= e($row['amount']) ?></td>
                        <td><span class="badge text-bg-primary"><?= e($row['status']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
