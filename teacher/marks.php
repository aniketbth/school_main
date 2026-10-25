<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['teacher'], true)) redirect('/403.php');

$pageTitle = 'Marks Entry';
include __DIR__ . '/../includes/header.php';
$subjects = fetch_all('SELECT * FROM subjects ORDER BY subject_name');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_teacher.php'; ?>
    <div class="content-panel">
        <h2>Marks Entry</h2>
        <div class="glass-card p-4 mt-3">
            <form class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Class</label>
                    <select class="form-select">
                        <option>Class 6</option>
                        <option>Class 9</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Subject</label>
                    <select class="form-select">
                        <?php foreach ($subjects as $s): ?><option><?= e($s['subject_name']) ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Exam</label>
                    <select class="form-select">
                        <option>Unit Test 1</option>
                        <option>Mid Term</option>
                    </select>
                </div>
            </form>

            <table class="table mt-4 align-middle">
                <thead><tr><th>Student</th><th>Marks</th><th>Grade</th></tr></thead>
                <tbody>
                    <tr><td>Student One</td><td><input type="number" value="88" class="form-control" style="max-width:120px;"></td><td>A</td></tr>
                    <tr><td>Student Two</td><td><input type="number" value="76" class="form-control" style="max-width:120px;"></td><td>B+</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
