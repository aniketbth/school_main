<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Server Error';
include __DIR__ . '/includes/header.php';
?>
<main class="container py-5">
    <div class="glass-card p-5 text-center">
        <h1 class="display-4">500</h1>
        <p>Something went wrong on the server.</p>
        <a href="/" class="btn btn-primary">Try Again</a>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
