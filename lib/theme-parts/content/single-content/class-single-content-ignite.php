<?php

class Single_Content_Ignite {


	public function get_part( $context = 'single', $args = array() ) {

		$html = '<div id="site-content">';

		while ( have_posts() ) {

			the_post();

			global $post;

			$show_title = get_post_meta( get_the_ID(), '_show_title_single_ignite', true );

			if ( empty( $show_title ) || ( 'default' === $show_title ) ) {

				$show_title = get_theme_mod( '_show_page_title_ignite', 'default' );

			} // end if

			$show_title = apply_filters( 'show_title_ignite', $show_title, $post );

			ob_start();

			require __DIR__ . '/single-content.php';

			$html .= ob_get_clean();

		} // End while

		$html .= '</div>';

		return apply_filters( 'theme_content_html', $html );

	} // End get_the_footer


} // End Single_Content_Ignite
