import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ==========================================
// MOBILE NAVIGATION
// ==========================================

document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    if (!menuToggle || !navMenu) {
        return;
    }

    menuToggle.addEventListener('click', function () {

        navMenu.classList.toggle('mobile-open');

    });

});