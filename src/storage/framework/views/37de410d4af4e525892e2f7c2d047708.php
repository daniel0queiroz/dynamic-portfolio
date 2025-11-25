<section class="experience-area section-padding">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 d-none d-lg-block">
                <figure class="single-image wow fadeInLeft">
                    <img src="<?php echo e($experience?->image); ?>" alt="">
                </figure>
            </div>
            <div class="col-lg-6">
                <div class="experience-text">
                    <h3 class="title wow fadeInUp" data-wow-delay="0.3s"><?php echo e($experience?->title); ?></h3>
                    <div class="desc wow fadeInUp" data-wow-delay="0.4s">
                       <?php echo $experience?->description; ?>

                    </div>
                    <div class="row">
                        <?php if(!empty($experience->phone)): ?>
                            <div class="col-sm-6">
                                <div class="icon-info wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="icon"><i class="fas fa-mobile-android-alt"></i></div>
                                    <h6><a href="https://wa.me/<?php echo e(preg_replace('/\D/', '', $experience->phone)); ?>" target="_blank"  class="text"><?php echo e($experience->phone); ?></a></h6>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-sm-6">
                            <div class="icon-info wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon"><i class="fas fa-envelope"></i></div>
                                <h6><a href="mailto:<?php echo e($experience?->email); ?>"  class="text"><?php echo e($experience?->email); ?></a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH /var/www/src/resources/views/frontend/sections/experience.blade.php ENDPATH**/ ?>