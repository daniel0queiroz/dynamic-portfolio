<section class="portfolio-area section-padding-top" id="portfolio-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="section-title">
                    <h3 class="title"><?php echo e($portfolioTitle?->title); ?></h3>
                    <div class="desc">
                        <?php echo $portfolioTitle?->sub_title; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <ul class="filter-menu">
                    <li class="active" data-filter="*">All Projects</li>
                    <?php $__currentLoopData = $portfolioCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li data-filter=".<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </ul>
            </div>
        </div>
        <div class="portfolio-wrapper">
            <div class="row portfolios">
                <?php $__currentLoopData = $portfolioItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div data-wow-delay="0.3s" class="col-md-6 col-lg-4 filter-item <?php echo e($item->category->slug); ?>">
                    <div class="single-portfolio">
                        <figure class="portfolio-image">
                            <img src="<?php echo e(asset($item->image)); ?>" alt="">
                        </figure>
                        <div class="portfolio-content">
                            <a href="<?php echo e(asset($item->image)); ?>" data-lity class="icon"><i
                                    class="fas fa-plus"></i></a>
                            <h4 class="title"><a href="<?php echo e(route('show.portfolio', $item->id)); ?>"><?php echo e($item->title); ?></a></h4>
                            <div class="desc">
                                <p><?php echo Str::limit(strip_tags($item->description), 100); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="row">
                <div class="text-center">
                <a href="<?php echo e(route('portfolio')); ?>" class="button-primary-trans mouse-dir">
                    View More <span class="dir-part"></span> 
                    <i class="fal fa-arrow-right"></i>
                </a>
                   </div>
            </div>
        </div>
    </div>
</section><?php /**PATH /var/www/src/resources/views/frontend/sections/portfolio.blade.php ENDPATH**/ ?>