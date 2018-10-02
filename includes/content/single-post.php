<div id="site-content">
	<?php while( have_posts() ) : the_post();

		$show_title = get_post_meta( get_the_ID(), '_show_title_single_ignite', true );

		$post_meta = 'Posted by ' . get_the_author_meta( 'display_name' ) . ' | ' . get_the_date();

		if ( empty( $show_title ) || ( $show_title == 'default' ) ) {

			$show_title = get_theme_mod( '_show_post_title_ignite', 'default' );

		} // end if

		$show_title = apply_filters( 'show_title_ignite', $show_title, $post );

	?>
	<article class="site-article">
		<header>
			<?php if ( 'remove' !== $show_title ) : ?><h1 class="<?php if ( 'hide' === $show_title ) { echo ' hidden-element'; } ?>"><?php the_title() ?></h1><?php endif ?>
		</header>
		<div class="acticle-meta" style="font-size: 14px; margin-bottom: 18px;">
			<?php echo esc_html( $post_meta ); ?>
		</div>
		<div class="article-content">
			<?php the_content() ?>
		</div>
		<footer>
		<?php if ( comments_open() || get_comments_number() ) : ?>
     		<?php comments_template(); ?>
		<?php endif; ?>
		</footer>
	</article>
	<?php endwhile; ?>
</div>
