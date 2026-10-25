<?php
session_start();
require_once __DIR__ . '/config/constants.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Admission';
include __DIR__ . '/includes/header.php';
?>
<main class="container py-5">
    <div class="glass-card p-5">
        <h1>Admission Enquiry</h1>
        <form method="post" action="/api/enquiry.php" class="row g-3 mt-3">
            <?= csrf_field(); ?>
            <div class="col-md-6"><input class="form-control" name="name" placeholder="Full Name" required></div>
            <div class="col-md-6"><input class="form-control" name="phone" placeholder="Phone Number" required></div>
            <div class="col-md-6"><input class="form-control" name="email" type="email" placeholder="Email Address"></div>
            <div class="col-md-6"><input class="form-control" name="class" placeholder="Class Applied"></div>
            <div class="col-12"><textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea></div>
            <div class="col-12"><button class="btn btn-primary">Submit Enquiry</button></div>
        </form>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
