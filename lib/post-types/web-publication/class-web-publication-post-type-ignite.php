<?php

class Web_Publication_Post_Type_Ignite extends Post_Type_Ignite {

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ) );

	} // End __construct


	public function register_post_type() {

		if ( $this->check_enabled( 'web_publication' ) ) {

			$labels = array(
				'name'               => 'Web Publication',
				'singular_name'      => 'Web Publication',
				'menu_name'          => 'Web Publication',
				'name_admin_bar'     => 'Web Publication',
				'add_new'            => 'Add Web Publication',
				'add_new_item'       => 'Add Web Publication',
				'new_item'           => 'New Web Publication',
				'edit_item'          => 'Edit Web Publication',
				'view_item'          => 'View Web Publication',
				'all_items'          => 'All Web Publication',
				'search_items'       => 'Search Web Publication',
				'parent_item_colon'  => 'Parent Web Publication:',
				'not_found'          => 'No Web Publication found.',
				'not_found_in_trash' => 'No Web Publication found in Trash.',
			);

			$args = array(
				'labels'             => $labels,
				'description'        => 'Web Publication for Theme use.',
				'public'             => true,
				'show_in_menu'       => true,
				'rewrite'            => array( 'slug' => 'content' ),
				'capability_type'    => 'post',
				'show_in_rest'       => true,
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'taxonomies'         => array( 'category', 'post_tag' ),
			);

			register_post_type( 'web_publication', $args );

		} // End if

	} // End register_post_type


} // Web_Publication_Post_Type_Ignit

$web_publication_post_type_ignite = new Web_Publication_Post_Type_Ignite();
