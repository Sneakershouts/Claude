// Sneaker Shouts - Main JS

document.addEventListener('DOMContentLoaded', function () {

  // ── SEARCH OVERLAY ──────────────────────────────────────
  const searchOverlay = document.querySelector('.search-overlay');
  if (searchOverlay) {
    searchOverlay.style.display = 'flex';
    searchOverlay.style.opacity = '0';
    searchOverlay.style.pointerEvents = 'none';
    searchOverlay.style.transition = 'opacity 0.2s ease';

    document.querySelectorAll('.nav-search').forEach(function (btn) {
      btn.addEventListener('click', function () {
        searchOverlay.style.opacity = '1';
        searchOverlay.style.pointerEvents = 'all';
        searchOverlay.querySelector('input[type="search"]')?.focus();
      });
    });

    searchOverlay.addEventListener('click', function (e) {
      if (e.target === searchOverlay) {
        searchOverlay.style.opacity = '0';
        searchOverlay.style.pointerEvents = 'none';
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        searchOverlay.style.opacity = '0';
        searchOverlay.style.pointerEvents = 'none';
      }
    });
  }

  // ── STICKY NAV SHADOW ───────────────────────────────────
  const header = document.querySelector('.site-header');
  if (header) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 10) {
        header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.08)';
      } else {
        header.style.boxShadow = 'none';
      }
    });
  }

});
