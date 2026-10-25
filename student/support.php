<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/functions.php';

if (!is_logged_in()) {
    redirect('/login.php');
}

$pageTitle = 'Stay Updated';
include __DIR__ . '/../includes/header.php';
?>
<div class="container py-5">
    <div class="glass-card p-5">
        <h1>Student Support</h1>
        <p class="text-muted">Use this section for announcements, FAQs, results, certificates, and student help desk.</p>
        <div class="row g-4 mt-2">
            <div class="col-md-4"><div class="glass-card p-4"><h5>Exam Dates</h5><p>Check upcoming test dates and schedules.</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Certificates</h5><p>Apply for bonafide, transfer, and character certificates.</p></div></div>
            <div class="col-md-4"><div class="glass-card p-4"><h5>Contact</h5><p>Reach admin, teacher, or front office support.</p></div></div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
