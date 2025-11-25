<?php $__env->startSection('content'); ?>
        <header class="site-header parallax-bg">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-sm-7">
                        <h2 class="title">Portfolio</h2>
                    </div>
                    <div class="col-sm-5">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Projects</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Portfolio-Area-Start -->
        <section class="card-area section-padding">
            <div class="container">
                <div class="row">
                    <?php $__currentLoopData = $portfolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portfolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-4 col-md-6">
                            <div class="single-card">
                                <figure class="card-image">
                                    <img src="<?php echo e(asset($portfolio->image)); ?>" alt="">
                                </figure>
                                <div class="card-content">
                                    <h3 class="title"><a href="<?php echo e(route('show.portfolio', $portfolio->id)); ?>"><?php echo e($portfolio->title); ?></a></h3>
                                    <div class="desc">
                                        <p><?php echo Str::limit(strip_tags($portfolio->description), 150, '...'); ?></p>
                                    </div>
                                    <a href="<?php echo e(route('show.portfolio', $portfolio->id)); ?>" class="button-primary-trans mouse-dir">View Project <span
                                            class="dir-part"></span> <i class="fal fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <nav class="navigation pagination">
                            <div class="nav-links d-flex justify-content-center">
                                <?php echo e($portfolios->links()); ?>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio-Area-End -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/src/resources/views/frontend/portfolio.blade.php ENDPATH**/ ?>