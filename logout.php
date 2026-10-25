<?php
session_start();
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../config/db.php';

$logout = $_GET['logout'] ?? null;
if ($logout === '1') {
    session_unset();
    session_destroy();
    redirect('/login.php');
}

require_login();
redirect(get_dashboard_url($_SESSION['school_user']['role_slug']));
