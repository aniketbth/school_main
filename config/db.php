<?php
if (!defined('APP_NAME')) {
    define('APP_NAME', 'School Management System');
}
if (!defined('APP_URL')) {
    define('APP_URL', 'http://localhost');
}

$ROLE_MAP = [
    'super_admin' => 'Super Admin',
    'admin' => 'Admin',
    'principal' => 'Principal',
    'teacher' => 'Teacher',
    'student' => 'Student',
    'parent' => 'Parent',
    'accountant' => 'Accountant',
    'librarian' => 'Librarian',
    'receptionist' => 'Receptionist',
];

$ROLE_SLUGS = array_keys($ROLE_MAP);
