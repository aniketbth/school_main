<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) {
    redirect('/login.php');
}
if (!in_array(user_role(), ['super_admin', 'admin'], true)) {
    redirect('/403.php');
}

$pageTitle = 'Admissions';
include __DIR__ . '/../includes/header.php';
$rows = fetch_all('SELECT * FROM admissions_applications ORDER BY created_at DESC LIMIT 20');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_admin.php'; ?>
    <div class="content-panel">
        <h2>Admissions</h2>
        <div class="glass-card p-4 mt-3">
            <table class="table table-hover align-middle">
                <thead>
                    <tr><th>Name</th><th>Phone</th><th>Class</th><th>Status</th><th>Application No</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= e($row['applicant_name']) ?></td>
                        <td><?= e($row['phone']) ?></td>
                        <td><?= e($row['class_applied']) ?></td>
                        <td><span class="badge text-bg-primary"><?= e($row['status']) ?></span></td>
                        <td><?= e($row['application_no']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
