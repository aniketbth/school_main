<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/functions.php';

if (!is_logged_in()) {
    redirect('/login.php');
}

$pageTitle = 'Library';
include __DIR__ . '/../includes/header.php';
$issues = fetch_all('SELECT li.*, b.title, s.student_name FROM library_issues li LEFT JOIN library_books b ON b.id=li.book_id LEFT JOIN students s ON s.id=li.student_id ORDER BY li.issue_date DESC LIMIT 20');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_librarian.php'; ?>
    <div class="content-panel">
        <h2>Book Issues</h2>
        <div class="glass-card p-4 mt-3">
            <table class="table align-middle">
                <thead><tr><th>Student</th><th>Book</th><th>Issue Date</th><th>Due Date</th></tr></thead>
                <tbody>
                    <?php foreach ($issues as $issue): ?>
                    <tr>
                        <td><?= e($issue['student_name'] ?? '-') ?></td>
                        <td><?= e($issue['title'] ?? '-') ?></td>
                        <td><?= e($issue['issue_date']) ?></td>
                        <td><?= e($issue['return_due_date']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
