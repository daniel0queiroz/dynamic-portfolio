<section class="testimonial-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="section-title">
                    <h3 class="title"><?php echo e($feedbackTitle?->title); ?></h3>
                    <div class="desc">
                        <p><?php echo e($feedbackTitle?->sub_title); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="testimonial-slider">
                    <?php $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-testimonial">
                        <div class="testimonial-header">
                            <div class="quote">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <h5 class="title"><?php echo e($feedback->name); ?></h5>
                            <h6 class="position"><?php echo e($feedback->position); ?></h6>
                        </div>
                        <div class="content">
                            <?php echo $feedback->description; ?>

                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH /var/www/src/resources/views/frontend/sections/testimonial.blade.php ENDPATH**/ ?>