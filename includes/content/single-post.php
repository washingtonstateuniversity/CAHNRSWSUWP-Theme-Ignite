<div id="site-content">
	<?php while ( have_posts() ) : the_post();

		$show_title = get_post_meta( get_the_ID(), '_show_title_single_ignite', true );

		if ( empty( $show_title ) || ( 'default' === $show_title ) ) {

			$show_title = get_theme_mod( '_show_post_title_ignite', 'default' );

		} // end if

		$show_title = apply_filters( 'show_title_ignite', $show_title, $post );

		?>
	<article class="site-article">
		<header>
			<?php if ( 'remove' !== $show_title ) : ?><h1 class="<?php if ( 'hide' === $show_title ) { echo ' hidden-element'; } ?>"><?php the_title() ?></h1><?php endif ?>
		</header>
		<div class="acticle-meta" style="font-size: 14px; margin-bottom: 18px;">
			<?php

			$blog = get_page_by_path( 'blog' );

			if ( get_theme_mod( '_cahnrswp_link_author_to_posts' ) ) {
				echo 'Posted by <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_attr( get_the_author_meta( 'display_name' ) ) . '</a> | ' . esc_attr( get_the_date() );
			} else {
				echo 'Posted by ' . esc_attr( get_the_author_meta( 'display_name' ) ) . ' | ' . esc_attr( get_the_date() );
			};
			?>
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
