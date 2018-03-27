<div class="ignite-slide <?php echo esc_html( $slideshow['height_class'] ); ?><?php if ( 0 === $slide['index'] ) : ?> active<?php endif; ?>">
	<div class="ignite-slide-image-wrapper">
		<div class="ignite-slide-image" style="background-image:url(<?php echo esc_url( $slide['image'] ); ?>);">
			<?php echo esc_html( $slide['alt'] ); ?>
		</div>
	</div>
	<?php if ( $slideshow['show_caption'] ) : ?><div class="ignite-slide-caption-wrapper">
		<div class="ignite-slide-caption">
			<div class="ignite-slide-caption-inner">
				<div class="ignite-slide-caption-title">
					<?php echo wp_kses_post( $slide['title'] ); ?>
				</div>
				<div class="ignite-slide-caption-excerpt">
					<?php echo wp_kses_post( $slide['excerpt'] ); ?>
				</div>
			</div>
		</div>
	</div><?php endif; ?>
	<?php if ( ! empty( $slide['link'] ) ) : ?><div class="ignite-slide-link-wrapper"><a href="<?php echo esc_url( $slide['link'] ); ?>"><?php echo wp_kses_post( $slide['title'] ); ?></a></div><?php endif; ?>
</div>
