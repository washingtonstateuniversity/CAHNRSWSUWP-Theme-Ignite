<div class="<?php echo esc_html( implode( ' ', $classes ) ); ?>">
	<?php if ( $image ) : ?><div class="image-wrapper" style="background-image:url(<?php echo esc_url( $image['src'] ); ?>)">
	</div><?php endif; ?>
	<div class="caption-wrapper">
		<div class="item-title">
			<h3><?php esc_html( the_title() ); ?></h3>
		</div>
		<div class="item-excerpt">
			<?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 25 ) ); ?>
		</div>
	</div>
	<div class="link-wrapper"><a href="<?php echo esc_url( get_post_permalink( get_the_ID() ) ); ?>">Learn more about <?php wp_kses_post( the_title() ); ?></a></div>
</div>
