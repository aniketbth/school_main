<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Page Not Found';
include __DIR__ . '/includes/header.php';
?>
<main class="container py-5">
    <div class="glass-card p-5 text-center">
        <h1 class="display-4">404</h1>
        <p>The page you are looking for could not be found.</p>
        <a href="/" class="btn btn-primary">Go Home</a>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
