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
    ];

    // Multiple elements: [selector, 'text'|'html']
    var multiples = [
        ['.service-area .single-service h3.title',              'text'],
        ['.service-area .single-service .desc p',               'text'],
        ['.skills-area .bar_group .title',                      'text'],
        ['.portfolio-area .portfolio-content h4.title a',       'text'],
        ['.portfolio-area .filter-menu li:not(:first-child)',   'text'],
        ['.footer-area .col-lg-2 .nav-menu li a',               'text'],
        ['.footer-area .col-lg-3:last-child .nav-menu li a',    'text'],
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
        var newTitles = null;
        newDoc.querySelectorAll('script').forEach(function (s) {
            var m = s.textContent.match(/\.typer\((\[[\s\S]*?\])\)/);
            if (m) {
                try { newTitles = JSON.parse(m[1]); } catch (e) {}
            }
        });
        if (!newTitles) return;
        var typerEl = document.querySelector('.header-area .typer-title');
        if (!typerEl) return;
        // Replace element to clear plugin state, then reinit
        var fresh = typerEl.cloneNode(false);
        typerEl.parentNode.replaceChild(fresh, typerEl);
        $(fresh).typer(newTitles);
    }

    function updateNavbar(locale) {
        var dropdown = document.getElementById('langDropdown');
        if (dropdown) dropdown.textContent = locale.toUpperCase();
        document.querySelectorAll('.dropdown-item').forEach(function (item) {
            var href = item.getAttribute('href') || '';
            item.classList.toggle('active', href.endsWith('/' + locale));
        });
    }

    // ─── Main switch function ─────────────────────────────────────────────────
    async function switchLanguage(locale) {
        var preloader = document.querySelector('.preloader');
        if (preloader) {
            preloader.style.cssText = 'display:flex;opacity:1;';
        }

        try {
            var resp = await fetch('/lang/' + locale, {
                redirect: 'follow',
                credentials: 'same-origin'
            });
            var html = await resp.text();
            var newDoc = new DOMParser().parseFromString(html, 'text/html');

            // Swap single elements
            singles.forEach(function (rule) {
                swapEl(
                    document.querySelector(rule[0]),
                    newDoc.querySelector(rule[0]),
                    rule[1]
                );
            });

            // Swap multiple elements by index
            multiples.forEach(function (rule) {
                var els    = document.querySelectorAll(rule[0]);
                var newEls = newDoc.querySelectorAll(rule[0]);
                els.forEach(function (el, i) {
                    swapEl(el, newEls[i], rule[1]);
                });
            });

            // Reinit sliders
            reinitSlider('.testimonial-slider', testimonialSlickOpts, newDoc);
            reinitSlider('.blog-slider',        blogSlickOpts,        newDoc);

            // Reinit typer
            reinitTyper(newDoc);

            // Update navbar locale display
            updateNavbar(locale);

        } catch (e) {
            // Fallback: navigate normally
            window.location.href = '/lang/' + locale;
            return;
        }

        if (preloader) {
            $(preloader).fadeOut(400);
        }
    }

    // ─── Intercept lang switcher clicks ──────────────────────────────────────
    document.addEventListener('click', function (e) {
        var link = e.target.closest('a[href*="/lang/"]');
        if (!link) return;
        var m = (link.getAttribute('href') || '').match(/\/lang\/([a-z]+)/);
        if (!m) return;
        e.preventDefault();
        switchLanguage(m[1]);
    });

})(jQuery);
