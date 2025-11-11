<?php
	$footerInfo = \App\Models\FooterInfo::first();
	$footerIcons = \App\Models\FooterSocialLink::all();
	$footerUsefulLinks =  \App\Models\FooterUsefulLink::all();
	$footerContact = \App\Models\FooterContactInfo::first();
	$footerHelpLinks = \App\Models\FooterHelpLink::all();
?>

<!-- Footer-Area-Start -->
		<footer class="footer-area">
			<div class="container">
				<div class="row footer-widgets">
					<div class="col-md-12 col-lg-3 widget">
						<div class="text-box">
							<figure class="footer-logo">
								<img src="<?php echo e(asset($generalSetting?->footer_logo)); ?>" alt="">
							</figure>
							<p><?php echo e($footerInfo?->info); ?></p>
							<ul class="d-flex flex-wrap">
								<?php $__currentLoopData = $footerIcons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li><a href="<?php echo e($icon->url); ?>" target="_blank"><i class="<?php echo e($icon->icon); ?>"></i></a></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
					</div>
					<div class="col-md-4 col-lg-2 offset-lg-1 widget">
						<h3 class="widget-title">Useful Links</h3>
						<ul class="nav-menu">
							<?php $__currentLoopData = $footerUsefulLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usefulLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><a href="<?php echo e($usefulLink->url); ?>"><?php echo e($usefulLink->name); ?></a></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
					<div class="col-md-4 col-lg-3 widget">
						<h3 class="widget-title">Contact Info</h3>
						<ul>
							<li><?php echo e($footerContact?->address); ?></li>
							<li><a href="#"><?php echo e($footerContact?->phone); ?></a></li>
							<li><a href="#"><?php echo e($footerContact?->email); ?></a></li>
						</ul>
					</div>
					<div class="col-md-4 col-lg-3 widget">
						<h3 class="widget-title">Help</h3>
						<ul class="nav-menu">
							<?php $__currentLoopData = $footerHelpLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $footerHelpLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><a href="<?php echo e($footerHelpLink->url); ?>"><?php echo e($footerHelpLink->name); ?></a></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="copyright">
								<p><?php echo e($footerInfo?->copy_right); ?></p>
								<p><?php echo e($footerInfo?->powered_by); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- Footer-Area-End --><?php /**PATH /var/www/src/resources/views/frontend/layouts/footer.blade.php ENDPATH**/ ?>