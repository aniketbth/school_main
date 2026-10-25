<?php
if (!function_exists('flash')) {
    function flash($type, $message) {
        $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
    }
}

if (!function_exists('render_flash')) {
    function render_flash() {
        if (!empty($_SESSION['flash'])) {
            foreach ($_SESSION['flash'] as $item) {
                echo '<div class="alert alert-' . e($item['type']) . ' alert-dismissible fade show" role="alert">'
                    . e($item['message'])
                    . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
            unset($_SESSION['flash']);
        }
    }
}
