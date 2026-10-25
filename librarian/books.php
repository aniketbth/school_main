<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['librarian'], true)) redirect('/403.php');

$pageTitle = 'Books';
include __DIR__ . '/../includes/header.php';
$rows = fetch_all('SELECT * FROM library_books ORDER BY title');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_librarian.php'; ?>
    <div class="content-panel">
        <h2>Books Catalog</h2>
        <div class="glass-card p-4 mt-3">
            <table class="table align-middle">
                <thead><tr><th>Title</th><th>Author</th><th>Category</th><th>Available</th></tr></thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= e($row['title']) ?></td>
                        <td><?= e($row['author'] ?? '-') ?></td>
                        <td><?= e($row['category'] ?? '-') ?></td>
                        <td><?= e($row['available_quantity']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
