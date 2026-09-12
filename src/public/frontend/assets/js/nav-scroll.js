(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var navbarNav = document.getElementById('navbarNav');
        var mainMenu = document.querySelector('.main_menu');

        // .main_menu's rendered height while the mobile panel is open/closing
        // is inflated (the panel sits in normal flow inside it), so cache the
        // true *collapsed* height up front (the menu starts closed on load)
        // instead of measuring it live at click time.
        var collapsedHeaderHeight = mainMenu ? mainMenu.offsetHeight : 0;
        window.addEventListener('resize', function () {
            if (!navbarNav || !navbarNav.classList.contains('show')) {
                collapsedHeaderHeight = mainMenu ? mainMenu.offsetHeight : 0;
            }
        });

        function scrollToTarget(target) {
            var targetTop = target.getBoundingClientRect().top + window.pageYOffset - collapsedHeaderHeight;
            window.scrollTo({ top: targetTop, behavior: 'smooth' });
        }

        var links = navbarNav ? navbarNav.querySelectorAll('.nav-link[href^="#"]') : [];

        links.forEach(function (link) {
            link.addEventListener('click', function (e) {
                var hash = this.getAttribute('href');
                var target = hash.length > 1 ? document.querySelector(hash) : null;
                if (!target) {
                    return;
                }

                e.preventDefault();

                // Close the mobile panel and start scrolling at the same
                // time — waiting for the close animation to finish first
                // made the whole interaction feel sluggish.
                if (navbarNav.classList.contains('show') && window.bootstrap) {
                    bootstrap.Collapse.getOrCreateInstance(navbarNav).hide();
                }

                scrollToTarget(target);
            });
        });
    });
})();
