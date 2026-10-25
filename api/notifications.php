<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

$notifications = [
    ['title' => 'Welcome back', 'body' => 'Your school dashboard is ready.'],
    ['title' => 'Fee reminder', 'body' => 'Class 6 fees are due this week.'],
    ['title' => 'Important notice', 'body' => 'PTM is scheduled for Saturday morning.']
];

json_response('success', 'Notifications fetched', ['notifications' => $notifications]);
