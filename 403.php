<?php
require_once __DIR__ . '/includes/functions.php';
require_login();
$pageTitle = 'Access Denied';
include __DIR__ . '/includes/header.php';
?>
<main class="container py-5">
    <div class="glass-card p-5 text-center">
        <h1 class="display-4">403</h1>
        <p>You do not have permission to view this page.</p>
        <a href="/" class="btn btn-primary">Back Home</a>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
