<nav class="navbar navbar-expand-lg glass-nav sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <span class="brand-badge">SE</span>
            <span><?= e(get_setting('school_name', 'School ERP')) ?></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-center gap-lg-3">
                <li class="nav-item"><a class="nav-link" href="/about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="/admission.php">Admission</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact.php">Contact</a></li>
                <?php if (is_logged_in()): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= e(get_dashboard_url(user_role())) ?>">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="btn btn-primary btn-sm rounded-pill" href="/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
