<section id="site-banner" class="cahnrs-ignite-feature wide-static-slide parallax-banner">
	<div class="ci-slideshow inactive">
		<div class="ci-slide-set-wrap">
			<nav class="ci-slide-controls">
				<div class="ci-prev-slide"><span></span></div>
				<div class="ci-next-slide"><span></span></div>
			</nav>
			<div class="ci-slide-set"><?php foreach ( $slides as $index => $slide ) : ?>
				<div class="ci-slide<?php if ( 0 === $index ) : ?> active<?php endif; ?>">
					<div class="ci-slide-image-wrapper">
						<div class="ci-slide-image banner-image" style="background-image:url(<?php echo esc_url( $slide->post_images['full'] ); ?>);background-position: center; background-size: cover;">
						</div>
					</div>
					<div class="ci-slide-caption-wrapper">
						<div class="ci-slide-caption ci-content-wrap">
							<div class="ci-caption-inner">
								<div class="ci-caption-title">
									<h2><?php echo wp_kses_post( $slide->post_title ); ?></h2><span>Read More <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
									<?php echo wp_kses_post( $slide->get_link_html() ); ?><?php echo wp_kses_post( $slide->get_link_html( true ) ); ?>
								</div>
								<div class="ci-summary">
									<?php echo wp_kses_post( $slide->post_excerpt ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?></div>
		</div>
		<nav class="ci-slide-thumbs-control">
			<div class="ci-slide-thumbs-wrapper ci-content-wrap">
				<div class="ci-slide-thumbs-inner">
					<div class="ci-slide-thumbs">
						<?php foreach ( $slides as $index => $slide ) : ?>
						<div class="ci-slide-thumb<?php if ( 0 === $index ) : ?> active<?php endif; ?>" style="background-image:url(<?php echo esc_url( $slide->post_images['full'] ); ?>);background-position: center; background-size: cover;"></div>
						<?php endforeach; ?> 
					</div>
					<!--<a href="#" class="ci-more">More Featured Stories <i class="fa fa-chevron-right" aria-hidden="true"></i></a>-->
				</div>
			</div>
		</nav>
	</div>
</section><script><?php require 'wide-static-slides.js'; ?></script>
