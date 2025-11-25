<section class="card-area section-padding-top" id="blog-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="section-title">
                    <h3 class="title"><?php echo e($blogTitle?->title); ?></h3>
                    <div class="desc">
                        <p><?php echo e($blogTitle?->sub_title); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="blog-slider">
                    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-card">
                            <figure class="card-image">
                                <img src="<?php echo e(asset($blog->image)); ?>" alt="">
                            </figure>
                        <div class="card-content">
                            <h3 class="title"><a href="<?php echo e(route('show.blog', $blog->id)); ?>"><?php echo e($blog->title); ?></a></h3>
                            <div class="desc">
                                <p><?php echo Str::limit($blog->description, 150, '...'); ?></p>
                            </div>
                            <a href="<?php echo e(route('show.blog', $blog->id)); ?>" class="button-primary-trans mouse-dir">Read More <span
                                    class="dir-part"></span> <i class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="text-center mt-4">
                <a href="<?php echo e(route('blog')); ?>" class="button-primary-trans mouse-dir">
                    View More <span class="dir-part"></span> 
                    <i class="fal fa-arrow-right"></i>
                </a>
                </div>
        </div>
    </div>
</section><?php /**PATH /var/www/src/resources/views/frontend/sections/blog.blade.php ENDPATH**/ ?>