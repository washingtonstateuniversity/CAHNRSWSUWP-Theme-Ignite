<div class="news-item <?php if ( ! empty( $post->post_images ) ) : ?> has-image<?php endif; ?>"><?php if ( ! empty( $post->post_images ) ) : ?>
		<div class="image-wrapper">
			<div class="image" style="background-image:url(<?php echo esc_url( $post->post_images['medium'] ); ?>);">
			</div>
		</div>
	<?php endif; ?>
	<div class="caption-wrapper">
		<div class="caption">
			<h3><?php echo esc_html( $post->post_title ); ?></h3>
			<?php if ( $atts['show_date'] ) : ?><div class="meta">Published on <time><?php echo esc_html( date("F jS, Y", strtotime( $post->post_date ) ) ); ?></time></div><?php endif; ?>
			<div class="excerpt"><?php echo wp_kses_post( wp_trim_words( $post->post_excerpt, $atts['excerpt_length'] ) ); ?></div>
			<?php if ( $atts['show_read_more'] ) : ?><div class="more-button">Read More</div><?php endif; ?>
		</div>
	</div>
	<div class="link"><?php echo wp_kses_post( $post->get_link_html() ); ?><?php echo esc_html( $news_item['title'] ); ?><?php echo wp_kses_post( $post->get_link_html( true ) ); ?></div>
</div>
