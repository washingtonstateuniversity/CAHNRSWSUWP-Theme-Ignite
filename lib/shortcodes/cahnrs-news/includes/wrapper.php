<div class="cahnrs-news-shortcode shortcode-wrapper <?php echo esc_html( $atts['display'] ); ?>">
<?php if ( $atts['show_pagination_before'] ) : ?><?php echo wp_kses_post( $pagination_html ); ?><?php endif; ?>
	<?php echo  $inner_html; // Can't escape this ?>
	<?php if ( $atts['show_pagination'] && ! $atts['hide_pagination_after'] ) : echo wp_kses_post( $pagination_html ); endif; ?>
</div>
