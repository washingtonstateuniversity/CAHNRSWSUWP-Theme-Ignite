<?php if ( ! empty( $banner_image ) ) : ?>
<div id="site-banner" class="static-image-wide-banner parallax-banner<?php if ( ! empty( $classes ) ) : ?> <?php echo esc_html( implode( ' ', $classes ) ); ?><?php endif; ?>">
	<div class="banner-image-wrap" style="background-image:url(<?php echo esc_url( $banner_image ) ?>);">
		<div class="banner-image" style="background-image:url(<?php echo esc_url( $banner_image ) ?>);">
		</div>
	</div>
	<?php if ( is_active_sidebar( 'banner_inner' ) ) : ?><div id="widget-area-banner-inner"><?php dynamic_sidebar( 'banner_inner' ); ?></div><?php endif; ?>
</div><?php endif ?>
