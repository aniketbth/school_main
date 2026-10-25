<?php
session_start();
require_once __DIR__ . '/config/constants.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

if (is_logged_in()) {
    redirect(get_dashboard_url($_SESSION['school_user']['role_slug']));
}

$pageTitle = 'Login | School Management';
include __DIR__ . '/includes/header.php';
?>
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-lg-5">
            <div class="glass-card p-4 p-lg-5">
                <div class="text-center mb-4">
                    <div class="brand-badge mb-3">SE</div>
                    <h2 class="mb-1">School ERP Login</h2>
                    <p class="text-muted mb-0">Welcome back</p>
                </div>
                <?php render_flash(); ?>
                <form method="post" action="/api/auth.php?action=login">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="small text-primary">Forgot password?</a>
                    </div>
                    <button class="btn btn-primary w-100">Login</button>
                </form>
                <div class="mt-4 text-center small text-muted">
                    Demo accounts: admin@school.com, teacher@school.com, student@school.com, parent@school.com, etc. Password: password
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
