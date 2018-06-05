<?php

class Ignite_Banners {

	public function __construct() {

		global $ignite_wp_banners;

		$ignite_wp_banners = array();

		$this->include_banners();

		add_action( 'ignite_theme_banner', array( $this, 'render_banner' ), 10, 2 );

		add_action( 'customize_register', array( $this, 'add_customizer_settings' ) );

	} // End __construct


	public function render_banner( $context = 'single-content', $args = array() ) {

		$ignite_wp_banners = ignite_get_registered_banners();

		$banner_args = $this->get_banner_data( $context, $args );

		if ( ! empty( $banner_args['type'] ) ) {

			if ( array_key_exists( $banner_args['type'], $ignite_wp_banners ) ) {

				$banner = $ignite_wp_banners[ $banner_args['type'] ];

				if ( ! empty( $banner['render_callback'] ) ) {

					call_user_func_array( $banner['render_callback'], array( $context, $banner_args ) );

				} // End if
			} // End if
		} // End if

	} // End render_banner


	public function add_customizer_settings( $wp_customize ) {

		$panel = ignite_get_customizer_panel_slug();

		$section_id = 'ignite_theme_banners';

		$registered_banners = array(
			'default' => 'Default',
		);

		$registered_banners = array_merge( $registered_banners, ignite_get_registered_banners( true ) );

		$wp_customize->add_section(
			$section_id,
			array(
				'title' => 'Theme Banners',
				'panel' => $panel,
			)
		); // end add_section

		$post_types = array(
			'front_page' => 'Front Page',
			'post' => 'Post',
			'page' => 'Page',
		);

		foreach ( $post_types as $slug => $label ) {

			$wp_customize->add_setting(
				'ignite_theme_banner_' . $slug,
				array(
					'default'   => '#000000',
					'transport' => 'refresh',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'ignite_theme_banner_' . $slug . '_control',
					array(
						'label'      => $label . ' Banner',
						'settings'   => 'ignite_theme_banner_' . $slug,
						'section'    => $section_id,
						'type'    => 'select',
						'choices' => $registered_banners,
					)
				)
			);

			do_action( 'ignite_customizer_theme_banners_post_type', $wp_customize, $section_id, $slug, $label );

		} // End foreach

		$wp_customize->add_setting(
			'ignite_',
			array(
				'default'   => '#000000',
				'transport' => 'refresh',
			)
		);

	} // End add_customizer_settings


	protected function include_banners() {

		include_once ignite_get_theme_path( 'lib/banners-includes/title-banner/ignite-title-banner-include.php' );

	} // End include_banners


	protected function get_banner_data( $context, $args ) {

		$banner_args = array(
			'type'      => 'title_banner',
			'context'   => 'singular',
			'post_type' => 'page',
			'taxonomy'  => '',
			'term_id'   => '',
			'classes'   => array( 'page-post-type', 'is-front-page' ),
		);

		return $banner_args;

	} // End get_banner_type

} // End Ignite_Banners

$ignite_banners = new Ignite_Banners();
