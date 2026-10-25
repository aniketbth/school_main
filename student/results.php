<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['student'], true)) redirect('/403.php');

$pageTitle = 'Student Results';
include __DIR__ . '/../includes/header.php';
$student = fetch_row('SELECT * FROM students WHERE user_id = ?', [$_SESSION['school_user']['id']], 'i');
$results = fetch_all('SELECT * FROM fees WHERE student_id = ? ORDER BY id DESC LIMIT 5', [$student['id'] ?? 0], 'i');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_student.php'; ?>
    <div class="content-panel">
        <h2>Results & Fees</h2>
        <div class="row g-4 mt-2">
            <div class="col-lg-6">
                <div class="glass-card p-4">
                    <h5>Recent Fees</h5>
                    <table class="table mb-0">
                        <thead><tr><th>Month</th><th>Amount</th><th>Status</th></tr></thead>
                        <tbody>
                            <?php foreach ($results as $result): ?>
                            <tr><td><?= e($result['fee_month']) ?></td><td><?= e($result['amount']) ?></td><td><?= e($result['status']) ?></td></tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="glass-card p-4">
                    <h5>Academic Summary</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><span>Mathematics</span><strong>85%</strong></li>
                        <li class="list-group-item d-flex justify-content-between"><span>Science</span><strong>88%</strong></li>
                        <li class="list-group-item d-flex justify-content-between"><span>English</span><strong>90%</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
