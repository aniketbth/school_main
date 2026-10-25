<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/functions.php';

if (!is_logged_in()) {
    redirect('/login.php');
}

$pageTitle = 'Settings';
include __DIR__ . '/../includes/header.php';
$user = fetch_row('SELECT * FROM users WHERE id = ?', [$_SESSION['school_user']['id']], 'i');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_admin.php'; ?>
    <div class="content-panel">
        <h2>Profile & Security</h2>
        <div class="glass-card p-4 mt-3">
            <form class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input class="form-control" value="<?= e($user['name']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input class="form-control" value="<?= e($user['email']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input class="form-control" value="<?= e($user['phone'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Save Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
