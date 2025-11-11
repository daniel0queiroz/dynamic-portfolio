<section class="skills-area section-padding-top" id="skills-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h3 class="title"><?php echo e($skill?->title); ?></h3>
                            <div class="desc">
                                <p><?php echo e($skill?->sub_title); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row skills">
                    <?php $__currentLoopData = $skillItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-6">
                        <div class="bar_group wow fadeInUp" data-wow-delay="0.3s" data-max="100">
                            <div class="title"><?php echo e($item->name); ?></div>
                            <div class="bar_group__bar thick elastic" data-value="<?php echo e($item->percent); ?>" data-color="<?php echo e(getColor($loop->index)); ?>"
                                data-tooltip="true" data-show-values="false" data-unit="%"></div>
                        </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <figure class="single-image text-right wow fadeInRight">
                    <img src="<?php echo e(asset($skill?->image)); ?>" alt="">
                </figure>
            </div>
        </div>
    </div>
</section><?php /**PATH /var/www/src/resources/views/frontend/sections/skill.blade.php ENDPATH**/ ?>