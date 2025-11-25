<section class="about-area section-padding-top">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6">
                <figure class="about-image">
                    <img src="<?php echo e(asset($about?->image)); ?>" alt="" class="wow fadeInUp" data-wow-delay="0.3s">
                </figure>
            </div>
            <div class="col-lg-6">
                <div class="about-text">
                    <h3 class="title wow fadeInUp" data-wow-delay="0.3s"><?php echo e($about?->title); ?></h3>
                    <div class="desc wow fadeInUp" data-wow-delay="0.4s">
                        <?php echo $about?->description; ?>

                    </div>
                    <a href="<?php echo e(route('resume.download')); ?>" class="button-primary-trans mouse-dir wow fadeInUp" data-wow-delay="0.5s">
                        <span class="icon"><i class="fal fa-download"></i></span>
                        <span class="text">Download Resume</span>
                        <span class="dir-part"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH /var/www/src/resources/views/frontend/sections/about.blade.php ENDPATH**/ ?>