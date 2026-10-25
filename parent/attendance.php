<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['parent'], true)) redirect('/403.php');

$pageTitle = 'Attendance';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_parent.php'; ?>
    <div class="content-panel">
        <h2>Child Attendance</h2>
        <div class="glass-card p-4 mt-3">
            <table class="table align-middle">
                <thead><tr><th>Month</th><th>Present</th><th>Absent</th><th>Late</th></tr></thead>
                <tbody>
                    <tr><td>April</td><td>18</td><td>2</td><td>1</td></tr>
                    <tr><td>May</td><td>20</td><td>1</td><td>0</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
