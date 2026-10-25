document.addEventListener('DOMContentLoaded', function () {
    const theme = localStorage.getItem('school_theme') || 'light';
    document.documentElement.setAttribute('data-theme', theme);

    const toggle = document.querySelector('[data-theme-toggle]');
    if (toggle) {
        toggle.addEventListener('click', function () {
            const next = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', next);
            localStorage.setItem('school_theme', next);
        });
    }

    const bell = document.querySelector('.notification-bell');
    if (bell) {
        bell.addEventListener('click', function () {
            fetch('/api/notifications.php')
                .then(response => response.json())
                .catch(() => {});
        });
    }
});
