<?php

class CAHNRS_Theme_Part_Shortcode_Ignite {

	// @var array $default_settings Array of default settings
	protected $default_settings = array(
		'part_id' => '',
	);


	public function __construct() {

		add_action( 'init', array( $this, 'register_shortcode' ) );

		add_filter( 'shortcode_content_ignite', 'wptexturize' );
		add_filter( 'shortcode_content_ignite', 'convert_smilies' );
		add_filter( 'shortcode_content_ignite', 'convert_chars' );
		add_filter( 'shortcode_content_ignite', 'wpautop' );
		add_filter( 'shortcode_content_ignite', 'shortcode_unautop' );
		add_filter( 'shortcode_content_ignite', 'prepend_attachment' );

	} // End __construct


	public function register_shortcode() {

		add_shortcode( 'cahnrs_theme_part', array( $this, 'render_shortcode' ) );

		add_filter( 'cpb_shortcodes', array( $this, 'register_cpb_shortcode' ) );

	} // End register_shortcode


	/*
	* @desc Register Shortcode with Pagebuilder
	* @since 0.0.1
	*/
	public function register_cpb_shortcode( $shortcodes ) {

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, array(), 'cahnrs_theme_part' );

		$shortcodes['cahnrs_theme_part'] = array(
			'form_callback'         => array( $this, 'get_shortcode_form' ),
			'label'                 => 'Theme Parts', // Label of the item
			'render_callback'       => array( $this, 'render_shortcodee' ), // Callback to render shortcode
			'default_atts'          => $default_atts,
			'in_column'             => true, // Allow in column
		);

		return $shortcodes;

	} // End register_cpb_shortcode


	public function render_shortcode( $atts, $content, $tag ) {

		$html = '';

		//$inner_html = '';

		$default_atts = array(
			'part_id' => '',
		);

		$atts = shortcode_atts( $default_atts, $atts, $tag );

		if ( $atts['part_id'] ) {

			$post = get_post( $atts['part_id'] );

			//var_dump( $post );

			if ( $post ) {

				$content = apply_filters( 'widget_content_ignite', $post->post_content );

				$html .= do_shortcode( $content );

			} // end if
		} // End if

		return $html;

	} // End render_shortcode


	/*
	* @desc Get HTML for shortcode form
	* @since 3.0.0
	*
	* @param array $atts Shortcode attributes
	* @param string $content Shortcode content
	*
	* @return string HTML shortcode form output
	*/
	public function get_shortcode_form( $id, $settings, $content, $cpb_form ) {

		$args = array(
			'posts_per_page'   => -1,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'theme_part',
			'post_status'      => 'publish',
		);

		$post_options = array();

		$posts_array = get_posts( $args );

		foreach ( $posts_array as $tp_post ) {

			$post_options[ $tp_post->ID ] = $tp_post->post_title;

		} // End foreach

		$form_html = $cpb_form->select_field( \CAHNRSWP\Plugin\Pagebuilder\cpb_get_input_name( $id, true, 'part_id' ), $settings['part_id'], $post_options, 'Theme Parts' );

		return array(
			'Basic'    => $form_html,
		);

	} // End get_shortcode_form


} // end Search_Shortcode_Ignite

$cahnrs_theme_part_shortcode_ignite = new CAHNRS_Theme_Part_Shortcode_Ignite();
