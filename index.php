<?php
session_start();
require_once __DIR__ . '/config/constants.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Dashboard';
include __DIR__ . '/includes/header.php';

$stats = getSchoolStats();
?>
<main class="container py-5">
    <section class="hero glass-card p-4 p-lg-5 mb-4">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge rounded-pill bg-primary-subtle text-primary fw-semibold mb-3">Admissions Open 2025-26</span>
                <h1 class="display-5 fw-bold mb-3">A modern school experience for brighter futures.</h1>
                <p class="lead text-muted">Academic excellence, caring mentors, and smart management for Bettiah students.</p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="/admission.php" class="btn btn-primary">Apply Now</a>
                    <a href="/about.php" class="btn btn-light">About Us</a>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <div class="stat-grid mt-4 mt-lg-0">
                    <div class="glass-mini-card">
                        <strong><?= $stats['students']; ?></strong>
                        <span>Students</span>
                    </div>
                    <div class="glass-mini-card">
                        <strong><?= $stats['teachers']; ?></strong>
                        <span>Teachers</span>
                    </div>
                    <div class="glass-mini-card">
                        <strong><?= $stats['staff']; ?></strong>
                        <span>Staff</span>
                    </div>
                    <div class="glass-mini-card">
                        <strong><?= $stats['notices']; ?></strong>
                        <span>Notices</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="glass-card p-4 h-100">
                <div class="icon-wrap"><i class="bi bi-mortarboard"></i></div>
                <h4>Academic Excellence</h4>
                <p>Structured learning, student mentoring, and outcome-focused teaching.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card p-4 h-100">
                <div class="icon-wrap"><i class="bi bi-people"></i></div>
                <h4>Holistic Growth</h4>
                <p>Sports, arts, leadership, and co-curricular programs that build confidence.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card p-4 h-100">
                <div class="icon-wrap"><i class="bi bi-shield-check"></i></div>
                <h4>Safe Environment</h4>
                <p>Focused, disciplined, and secure school campus with transparent communication.</p>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="section-head d-flex justify-content-between align-items-center mb-3">
            <h3>Notice Board</h3>
            <a href="#" class="small text-primary">View all</a>
        </div>
        <div class="row g-3">
            <?php
            $notices = fetch_all('SELECT title, content, notice_type, published_at FROM notices WHERE is_active=1 ORDER BY published_at DESC LIMIT 3');
            foreach ($notices as $notice):
            ?>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <span class="badge text-bg-light mb-2"><?= e($notice['notice_type']) ?></span>
                    <h5><?= e($notice['title']) ?></h5>
                    <p class="text-muted mb-0"><?= strip_tags(substr($notice['content'], 0, 130)) ?>...</p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
