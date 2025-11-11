<?php
    $routeName = Route::currentRouteName();
?>

<nav class="navbar navbar-expand-lg main_menu" id="main_menu_area">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(asset($generalSetting?->logo)); ?>" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link <?php echo e($routeName == 'home' ? 'active' : ''); ?>"
                        href="<?php echo e($routeName == 'home' ? '#home-page' : url('/')); ?>">
                        Home
                    </a>
                </li>

                <?php if($routeName == 'home'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-page">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio-page">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#skills-page">Skills</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#blog-page">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact-page">Contact</a>
                    </li>
                <?php endif; ?>

                <?php if($routeName == 'portfolio' || $routeName == 'show.portfolio'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($routeName == 'portfolio' || $routeName == 'show.portfolio' ? 'active' : ''); ?>"
                            href="<?php echo e(route('portfolio')); ?>">
                            Portfolio
                        </a>
                    </li>
                <?php endif; ?>

                <?php if($routeName == 'blog' || $routeName == 'show.blog'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($routeName == 'blog' || $routeName == 'show.blog' ? 'active' : ''); ?>"
                            href="<?php echo e(route('blog')); ?>">
                            Blogs
                        </a>
                    </li>
                <?php endif; ?>

                <?php if($routeName == 'privacy-policy'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($routeName == 'privacy-policy' ? 'active' : ''); ?>" href="<?php echo e(route('privacy-policy')); ?>">
                            Privacy Policy
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH /var/www/src/resources/views/frontend/layouts/navbar.blade.php ENDPATH**/ ?>