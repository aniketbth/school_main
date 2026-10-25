<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['super_admin', 'admin'], true)) redirect('/403.php');

$pageTitle = 'Students';
include __DIR__ . '/../includes/header.php';
$rows = fetch_all('SELECT s.*, c.class_name FROM students s LEFT JOIN classes c ON c.id=s.class_id ORDER BY s.id DESC LIMIT 20');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_admin.php'; ?>
    <div class="content-panel">
        <h2>Student Directory</h2>
        <div class="glass-card p-4 mt-3">
            <table class="table align-middle">
                <thead>
                    <tr><th>Student</th><th>Admission</th><th>Class</th><th>Phone</th><th>Status</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= e($row['student_name']) ?></td>
                        <td><?= e($row['admission_no']) ?></td>
                        <td><?= e($row['class_name'] ?? '-') ?></td>
                        <td><?= e($row['phone'] ?? '-') ?></td>
                        <td><span class="badge text-bg-success"><?= e($row['status']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
