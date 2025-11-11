
<header class="header-area parallax-bg"  id="home-page" style="background: url('<?php echo e(asset($hero?->image)); ?>') no-repeat scroll top center/cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="header-text">
                    <h3 class="typer-title wow fadeInUp" data-wow-delay="0.2s">I'm ui/ux designer</h3>
                    <h1 class="title wow fadeInUp" data-wow-delay="0.3s"><?php echo e($hero?->title); ?></h1>
                    <div class="desc wow fadeInUp" data-wow-delay="0.4s">
                        <p><?php echo e($hero?->sub_title); ?>.</p>
                    </div>
                    <?php if($hero?->btn_text): ?>
                         <a href="<?php echo e($hero?->btn_url); ?>" class="button-dark mouse-dir wow fadeInUp" data-wow-delay="0.5s"><?php echo e($hero->btn_text); ?><span
                            class="dir-part"></span></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<?php $__env->startPush('scripts'); ?>
    <script>
        <?php
            $titles = [];
            foreach($typerTitles as $title){
                $titles[] = $title->title;
            }
            $titles = json_encode($titles);
        ?>
        $(".header-area .typer-title").typer(<?php echo $titles; ?>);
    </script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/src/resources/views/frontend/sections/hero.blade.php ENDPATH**/ ?>