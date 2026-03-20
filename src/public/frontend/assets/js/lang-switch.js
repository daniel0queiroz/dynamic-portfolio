(function ($) {
    'use strict';

    // ─── Slick options (mirrors main.js) ─────────────────────────────────────
    var blogSlickOpts = {
        dots: false, arrows: false, infinite: true, centerMode: false,
        autoplay: true, vertical: false, verticalSwiping: false, speed: 1000,
        slidesToShow: 3, slidesToScroll: 1,
        responsive: [
            { breakpoint: 1170, settings: { slidesToShow: 2, slidesToScroll: 1 } },
            { breakpoint: 992,  settings: { slidesToShow: 2, slidesToScroll: 1 } },
            { breakpoint: 768,  settings: { slidesToShow: 1, slidesToScroll: 1 } }
        ]
    };

    var testimonialSlickOpts = {
        dots: true, arrows: false, infinite: true, centerMode: false,
        autoplay: true, vertical: false, verticalSwiping: false, speed: 1000,
        slidesToShow: 2, slidesToScroll: 1,
        responsive: [
            { breakpoint: 1170, settings: { slidesToShow: 2, slidesToScroll: 1 } },
            { breakpoint: 992,  settings: { slidesToShow: 1, slidesToScroll: 1 } },
            { breakpoint: 768,  settings: { slidesToShow: 1, slidesToScroll: 1 } }
        ]
    };

    // ─── Element swap rules ───────────────────────────────────────────────────
    // Single elements: [selector, 'text'|'html']
    var singles = [
        ['.header-area h1.title',                          'text'],
        ['.header-area .header-text .desc p',              'text'],
        ['.header-area .button-dark',                      'html'],
        ['.about-area h3.title',                           'text'],
        ['.about-area .about-text .desc',                  'html'],
        ['.skills-area .section-title .title',             'text'],
        ['.skills-area .section-title .desc p',            'text'],
        ['.experience-area .experience-text h3.title',     'text'],
        ['.experience-area .experience-text .desc',        'html'],
        ['.testimonial-area .section-title .title',        'text'],
        ['.testimonial-area .section-title .desc p',       'text'],
        ['.card-area .section-title .title',               'text'],
        ['.card-area .section-title .desc p',              'text'],
        ['.contact-area .section-title .title',            'text'],
        ['.contact-area .section-title .desc p',           'text'],
        ['.portfolio-area .section-title .title',          'text'],
        ['.portfolio-area .section-title .desc',           'html'],
        ['.footer-area .text-box > p',                     'text'],
        ['.footer-bottom .copyright p:first-child',        'text'],
        ['.portfolio-area .filter-menu li.active',         'text'],
        ['.portfolio-area .button-primary-trans',          'html'],
        ['#blog-page .text-center .button-primary-trans',  'html'],
    ];

    // Multiple elements: [selector, 'text'|'html']
    var multiples = [
        ['.service-area .single-service h3.title',              'text'],
        ['.service-area .single-service .desc p',               'text'],
        ['.skills-area .bar_group .title',                      'text'],
        ['.portfolio-area .portfolio-content h4.title a',       'text'],
        ['.portfolio-area .filter-menu li',                     'text'],
        ['.button-primary-trans',                               'html'],
        ['.footer-area .col-lg-2 .nav-menu li a',               'text'],
        ['.footer-area .col-lg-3:last-child .nav-menu li a',    'text'],
        ['#main_menu_area .navbar-nav.ms-auto .nav-link',       'text'],
        ['.footer-area .widget-title',                          'text'],
    ];

    // ─── Helpers ──────────────────────────────────────────────────────────────
    function swapEl(el, newEl, type) {
        if (!el || !newEl) return;
        if (type === 'html') {
            el.innerHTML = newEl.innerHTML;
        } else {
            el.textContent = newEl.textContent;
        }
    }

    function reinitSlider(selector, opts, newDoc) {
        var $slider = $(selector);
        if (!$slider.length) return;
        var newContent = newDoc.querySelector(selector);
        if (!newContent) return;
        if ($slider.hasClass('slick-initialized')) {
            $slider.slick('unslick');
        }
        $slider.html(newContent.innerHTML);
        $slider.slick(opts);
    }

    function reinitTyper(newDoc) {
        var newEl = newDoc.querySelector('.header-area .typer-title');
        if (!newEl) return;
        var titles = [];
        try {
            titles = JSON.parse(newEl.getAttribute('data-typer-titles') || '[]');
        } catch (e) {}
        var typerEl = document.querySelector('.header-area .typer-title');
        if (!typerEl) return;
        // Replace element to clear plugin state, then reinit
        var fresh = typerEl.cloneNode(false);
        fresh.textContent = newEl.textContent || '';
        fresh.setAttribute('data-typer-titles', newEl.getAttribute('data-typer-titles') || '[]');
        typerEl.parentNode.replaceChild(fresh, typerEl);
        if (titles.length) {
            $(fresh).typer(titles);
        }
    }

    function updateNavbar(locale) {
        var dropdown = document.getElementById('langDropdown');
        if (dropdown) dropdown.textContent = locale.toUpperCase();
        document.querySelectorAll('.dropdown-item').forEach(function (item) {
            var href = item.getAttribute('href') || '';
            item.classList.toggle('active', href.endsWith('/' + locale));
        });
    }

    // ─── Intercept lang switcher clicks ──────────────────────────────────────
    document.addEventListener('click', function (e) {
        var link = e.target.closest('a[href*="/lang/"]');
        if (!link) return;
        var m = (link.getAttribute('href') || '').match(/\/lang\/([a-z]+)/);
        if (!m) return;

        // Preserve scroll position for a smoother UX after reload.
        try {
            sessionStorage.setItem('langSwitchScrollY', String(window.scrollY || 0));
        } catch (err) {}

        e.preventDefault();
        window.location.href = link.getAttribute('href');
    });

    // ─── Restore scroll position after language reload ───────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('#home-page')) return;
        try {
            var stored = sessionStorage.getItem('langSwitchScrollY');
            if (!stored) return;
            sessionStorage.removeItem('langSwitchScrollY');
            var y = parseInt(stored, 10);
            if (!isNaN(y)) {
                window.scrollTo(0, y);
            }
        } catch (err) {}
    });

})(jQuery);
