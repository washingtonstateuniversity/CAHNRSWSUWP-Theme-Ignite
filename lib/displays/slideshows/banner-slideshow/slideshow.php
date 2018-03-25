<div class="ignite-slideshow banner-slideshow <?php echo esc_html( $slideshow['height_class'] ); ?>" data-isauto="<?php echo esc_html( $slideshow['isauto'] ); ?>" data-speed="<?php echo esc_html( $slideshow['speed'] ); ?>" data-delay="<?php echo esc_html( $slideshow['delay'] ); ?>">
	<div class="ignite-slideshow-slides-wrapper">
		<?php echo wp_kses_post( $slides_html ); ?>
	</div>
	<?php if( $slideshow['show_nav'] ) : ?><div class="ignite-slideshow-nav-wrapper <?php echo esc_html( $slideshow['height_class'] ); ?>">
		<?php echo wp_kses_post( $slide_nav_html ); ?>
	</div><?php endif; ?>
</div>
