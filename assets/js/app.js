document.addEventListener('DOMContentLoaded', function () {
  const savedTheme = localStorage.getItem('school-theme') || 'light';
  document.documentElement.setAttribute('data-theme', savedTheme);

  const toggle = document.querySelector('[data-theme-toggle]');
  if (toggle) {
    toggle.addEventListener('click', function () {
      const nextTheme = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      document.documentElement.setAttribute('data-theme', nextTheme);
      localStorage.setItem('school-theme', nextTheme);
    });
  }

  if (window.fetch) {
    fetch('/api/notifications.php', { method: 'POST', headers: {'Content-Type': 'application/json'}, body: JSON.stringify({}) })
      .catch(() => {});
  }
});
