<?php
session_start();
require_once __DIR__ . '/config/constants.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Contact';
include __DIR__ . '/includes/header.php';
?>
<main class="container py-5">
    <div class="glass-card p-5">
        <h1>Contact Us</h1>
        <div class="row g-4 mt-2">
            <div class="col-lg-6">
                <p><strong>Address:</strong> Bettiah, West Champaran, Bihar</p>
                <p><strong>Phone:</strong> +91 98765 43210</p>
                <p><strong>Email:</strong> info@bettiahschool.edu</p>
            </div>
            <div class="col-lg-6">
                <form method="post" action="/api/enquiry.php">
                    <?= csrf_field(); ?>
                    <div class="mb-3"><input class="form-control" name="name" placeholder="Name" required></div>
                    <div class="mb-3"><input class="form-control" name="email" type="email" placeholder="Email"></div>
                    <div class="mb-3"><textarea class="form-control" name="message" rows="4" placeholder="Message" required></textarea></div>
                    <button class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
