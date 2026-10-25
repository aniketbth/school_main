<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/functions.php';

if (!is_logged_in()) {
    redirect('/login.php');
}
