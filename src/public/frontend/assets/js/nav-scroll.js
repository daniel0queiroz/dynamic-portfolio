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

        // ---- Active-link highlighting on scroll ----
        // Bootstrap's ScrollSpy only reacts to elements that have a matching
        // nav link. Sections with no nav link of their own (e.g. Skills,
        // Experience, sitting between Portfolio and Testimonials) create a
        // "dead zone" where the previous link stays highlighted for the
        // entire scroll through them. Instead, always highlight whichever
        // tracked section is closest, switching at the midpoint of any gap.
        var orderedSections = [];
        var switchBoundaries = [];

        function recomputeSections() {
            orderedSections = Array.prototype.map.call(links, function (link) {
                var hash = link.getAttribute('href');
                var el = hash.length > 1 ? document.querySelector(hash) : null;
                if (!el) {
                    return null;
                }
                var top = el.getBoundingClientRect().top + window.pageYOffset;
                return { link: link, top: top, bottom: top + el.offsetHeight };
            }).filter(Boolean).sort(function (a, b) {
                return a.top - b.top;
            });

            switchBoundaries = [];
            for (var i = 0; i < orderedSections.length - 1; i++) {
                switchBoundaries.push((orderedSections[i].bottom + orderedSections[i + 1].top) / 2);
            }
        }

        function updateActiveLink() {
            if (!orderedSections.length) {
                return;
            }

            var referencePoint = window.pageYOffset + collapsedHeaderHeight + 1;
            var index = 0;
            for (var i = 0; i < switchBoundaries.length; i++) {
                if (referencePoint >= switchBoundaries[i]) {
                    index = i + 1;
                }
            }

            orderedSections.forEach(function (section, i) {
                section.link.classList.toggle('active', i === index);
            });
        }

        if (links.length) {
            recomputeSections();
            updateActiveLink();

            window.addEventListener('scroll', updateActiveLink, { passive: true });

            window.addEventListener('resize', function () {
                recomputeSections();
                updateActiveLink();
            });
        }
    });
})();
