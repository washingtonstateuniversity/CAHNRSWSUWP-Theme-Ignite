<?php

class Ignite_Breadcrumbs {

	public function __construct() {

		$this->add_filters();

	} // End __construct


	protected function add_filters() {

		add_filter( 'ignite_post_content_single_html', array( $this, 'add_breadcrumb' ), 1 ); //why 11 again?

	} // End add_filters
	
	public function add_breadcrumb( $content ) {

		$breadcrumb_array = array(
			array( 
				'title' => 'Home',
				'link'  => get_home_url(),
			)
			// Home here so it always exits
		);

		if ( is_singular() ) {

			$breadcrumb_array = array_merge( $breadcrumb_array, $this->get_breadcrumb_array_singular() );

		} // End If

			$breadcrumb_html = '<ul class="breadcrumbs">';

		foreach( $breadcrumb_array as $crumb ) {

			$breadcrumb_html .= '<li><a href="' . $crumb['link'] . '">' . $crumb['title'] . '</a></li>';

		}

		$breadcrumb_html .= '</ul>';

		$content = $breadcrumb_html . $content; // Add breadcrumb_html to content

		remove_filter( 'the_content', array( $this, 'add_breadcrumb' ), 11 );

		return $content;

	} // End add_breadcrumb

	protected function get_breadcrumb_array_singular() {

		$breadcrumbs = array();

		$post_id = \get_the_ID();

		$ancestors = get_post_ancestors( $post_id );
		$ancestors = array_reverse($ancestors);

		foreach ( $ancestors as $ancestor ) {
			$title = get_the_title($ancestor);
			$link = get_permalink($ancestor);
		
			$temp = array( 
				'title' => $title,
				'link'  => $link,
			);

			$breadcrumbs[] = $temp;

		} //End foreach

		$title = get_the_title($post_id);
		$link = get_permalink($post_id);
		 
		$temp = array( 
			'title' => $title,
			'link'  => $link,
		);

		$breadcrumbs[] = $temp;

		return $breadcrumbs;

	}
} // End Ignite_Breadcrumb

$ignite_breadcrumbs = new Ignite_Breadcrumbs();
