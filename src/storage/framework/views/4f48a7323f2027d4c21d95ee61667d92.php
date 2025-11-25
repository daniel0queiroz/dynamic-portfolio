<?php $__env->startSection('content'); ?>
        <header class="site-header parallax-bg">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-sm-8">
                        <h2 class="title">404</h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                                <li>404</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Portfolio-Area-Start -->
        <section class="blog-details section-padding">
            <div class="container">
                <div class="row">
                    <div id="notfound">
                        <div class="notfound">
                            <div class="notfound-404">
                                <h1 style="background-image: url(<?php echo e(asset('frontend/assets/images/bg-test.png')); ?>)">Oops!</h1>
                            </div>
                            <h2>404 - Page not found</h2>
                            <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.
                            </p>
                            <a href="<?php echo e(url('/')); ?>">Go To Homepage</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/src/resources/views/errors/404.blade.php ENDPATH**/ ?>