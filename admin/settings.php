<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!is_logged_in()) redirect('/login.php');
if (!in_array(user_role(), ['super_admin', 'admin'], true)) redirect('/403.php');

$pageTitle = 'Settings';
include __DIR__ . '/../includes/header.php';
$settings = fetch_all('SELECT key_name, key_value FROM school_settings ORDER BY key_name');
?>
<div class="container py-4">
    <?php include __DIR__ . '/../includes/sidebar_admin.php'; ?>
    <div class="content-panel">
        <h2>School Settings</h2>
        <div class="glass-card p-4 mt-3">
            <form method="post" action="/api/settings.php">
                <?= csrf_field(); ?>
                <div class="row g-3">
                    <?php foreach ($settings as $setting): ?>
                    <div class="col-md-6">
                        <label class="form-label"><?= e($setting['key_name']) ?></label>
                        <input class="form-control" name="<?= e($setting['key_name']) ?>" value="<?= e($setting['key_value']) ?>">
                    </div>
                    <?php endforeach; ?>
                    <div class="col-12 mt-3">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
