(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var navbarNav = document.getElementById('navbarNav');
        var mainMenu = document.querySelector('.main_menu');

        function scrollToTarget(target) {
            var headerHeight = mainMenu ? mainMenu.offsetHeight : 0;
            var targetTop = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
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

                // On mobile, the collapsed menu panel is fixed on top of the
                // page — close it first and scroll only once it has finished
                // collapsing, so it doesn't stay covering the section.
                var isMobileMenuOpen = navbarNav.classList.contains('show');

                if (isMobileMenuOpen && window.bootstrap) {
                    navbarNav.addEventListener('hidden.bs.collapse', function onHidden() {
                        navbarNav.removeEventListener('hidden.bs.collapse', onHidden);
                        scrollToTarget(target);
                    });
                    bootstrap.Collapse.getOrCreateInstance(navbarNav).hide();
                } else {
                    scrollToTarget(target);
                }
            });
        });
    });
})();
