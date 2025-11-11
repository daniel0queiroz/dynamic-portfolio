<section class="service-area section-padding-top" id="about-page">
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 <?php echo e($loop->index > 2 ? 'mt-4' : ''); ?>">
                <div class="single-service">
                    <h3 class="title wow fadeInRight" data-wow-delay="0.3s"><?php echo e($service->name); ?></h3>
                    <div class="desc wow fadeInRight" data-wow-delay="0.4s">
                        <p><?php echo e($service->description); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </div>
    </div>
</section><?php /**PATH /var/www/src/resources/views/frontend/sections/service.blade.php ENDPATH**/ ?>