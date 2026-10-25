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

$pageTitle = 'School Report';
include __DIR__ . '/../includes/header.php';

$stats = getSchoolStats();
$students = fetch_all('SELECT s.student_name, c.class_name, s.status FROM students s LEFT JOIN classes c ON c.id=s.class_id ORDER BY s.id DESC LIMIT 10');
$teachers = fetch_all('SELECT teacher_name, designation FROM teachers ORDER BY id DESC LIMIT 10');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_admin.php'; ?>
    <div class="content-panel">
        <h2>School Reports</h2>

        <div class="row g-3 mb-4">
            <div class="col-md-3"><div class="glass-card p-4"><div class="small text-muted">Total Students</div><h3><?= $stats['students'] ?></h3></div></div>
            <div class="col-md-3"><div class="glass-card p-4"><div class="small text-muted">Teachers</div><h3><?= $stats['teachers'] ?></h3></div></div>
            <div class="col-md-3"><div class="glass-card p-4"><div class="small text-muted">Staff</div><h3><?= $stats['staff'] ?></h3></div></div>
            <div class="col-md-3"><div class="glass-card p-4"><div class="small text-muted">Notices</div><h3><?= $stats['notices'] ?></h3></div></div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="glass-card p-4">
                    <h5>Recent Students</h5>
                    <table class="table table-sm align-middle">
                        <thead><tr><th>Name</th><th>Class</th><th>Status</th></tr></thead>
                        <tbody>
                            <?php foreach ($students as $s): ?>
                            <tr>
                                <td><?= e($s['student_name']) ?></td>
                                <td><?= e($s['class_name'] ?? '-') ?></td>
                                <td><span class="badge text-bg-success"><?= e($s['status']) ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="glass-card p-4">
                    <h5>Staff Overview</h5>
                    <table class="table table-sm align-middle">
                        <thead><tr><th>Teacher</th><th>Designation</th></tr></thead>
                        <tbody>
                            <?php foreach ($teachers as $t): ?>
                            <tr>
                                <td><?= e($t['teacher_name']) ?></td>
                                <td><?= e($t['designation'] ?? '-') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
