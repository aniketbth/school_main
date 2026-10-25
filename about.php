<?php
session_start();
require_once __DIR__ . '/config/constants.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'About Us';
include __DIR__ . '/includes/header.php';
?>
<main class="container py-5">
    <div class="glass-card p-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h1>About Our School</h1>
                <p>We are a progressive educational institution in Bettiah, West Champaran, committed to excellence in academics, character, and co-curricular development.</p>
                <p>Our school blends tradition with innovation through dedicated teaching, modern classrooms, and a supportive learning environment that encourages every child to thrive.</p>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1200&q=80" alt="School campus" class="img-fluid rounded-4 shadow-lg" style="height:420px; object-fit:cover; width:100%;">
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
