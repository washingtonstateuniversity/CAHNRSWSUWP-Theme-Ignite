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

		$use_updated_banners = get_theme_mod( 'ignite_theme_banner_use_updated', false );

		if ( $use_updated_banners ) {

			$ignite_wp_banners = ignite_get_registered_banners();

			$banner_args = $this->get_banner_data( $context, $args );

			if ( ! empty( $banner_args['type'] ) ) {

				if ( array_key_exists( $banner_args['type'], $ignite_wp_banners ) ) {

					$banner = $ignite_wp_banners[ $banner_args['type'] ];

					if ( ! empty( $banner['render_callback'] ) ) {

						call_user_func_array( $banner['render_callback'], array( $context, $banner_args ) );

						include ignite_get_theme_path( 'lib/displays/widget-areas/banner-after.php' );

					} // End if
				} // End if
			} // End if
		} else {

			require_once CAHNRSIGNITEPATH . 'theme-parts/page-banners/class-page-banner-cahnrs-ignite.php';
			$page_banner = new Page_Banner_CAHNRS_Ignite();
			$page_banner->the_banner( 'page' );

		} // End If

	} // End render_banner


	public function add_customizer_settings( $wp_customize ) {

		$panel = ignite_get_customizer_panel_slug();

		$section_id = 'ignite_theme_banners';

		$registered_banners = array(
			'none'    => 'No Banner',
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

		$wp_customize->add_setting(
			'ignite_theme_banner_use_updated',
			array(
				'default'   => false,
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			'ignite_theme_banner_use_updated_control',
			array(
				'label'    => 'Use Updated Banners',
				'section'  => $section_id,
				'settings' => 'ignite_theme_banner_use_updated',
				'type'     => 'checkbox',
			)
		); // end control

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

		include_once ignite_get_theme_path( 'lib/includes/banners/title-banner/ignite-title-banner-include.php' );

		include_once ignite_get_theme_path( 'lib/includes/banners/dynamic-scroll/ignite-dynamic-scroll-banner-include.php' );

	} // End include_banners


	protected function get_banner_data( $context, $args ) {

		$banner_args = array(
			'type'      => '',
			'context'   => '',
			'post_type' => '',
			'taxonomy'  => '',
			'term_slug' => '',
			'classes'   => array(),
		);

		if ( is_tax() || is_category() || is_tag() ) {

			$term = get_queried_object();

			$image = get_theme_mod( '_cahnrswp_ignite_banner_' . $term->taxonomy . '_image', '' );

			$banner_args = $this->get_banner_data_taxonomy( $banner_args, $context, $args );

		} elseif ( is_front_page() ) {

			$banner_args = $this->get_banner_data_front_page( $banner_args, $context, $args );

		} elseif ( is_singular() ) {

			$banner_args = $this->get_banner_data_singular( $banner_args, $context, $args );

		} // End if

		if ( empty( $banner_args['type'] ) ) {

			$banner_args['type'] = 'default';

		} // End if

		return $banner_args;

	} // End get_banner_type


	protected function get_banner_data_singular( $banner_args, $context, $args ) {

		$post_type = get_post_type();

		if ( ! empty( $post_type ) ) {

			$banner_args['post_type'] = $post_type;

			$banner_args['context'] = 'singular';

			$banner_args['classes'][] = $post_type;

			if ( ! empty( $args['type'] ) ) {

				$banner_args['type'] = $args['type'];

			} else {

				$banner_args['type'] = get_theme_mod( 'ignite_theme_banner_' . $post_type, '' );

				// Legacy check for old banner settings
				if ( empty( $banner_args['type'] ) ) {

					$post_type = str_replace( '-', '_', $post_type );

					$banner_args['type'] = get_theme_mod( '_cahnrswp_ignite_banner_' . $post_type . '_type', '' );

				} // End if
			}// End if
		} // End if

		return $banner_args;

	} // End get_banner_data_singular


	protected function get_banner_data_front_page( $banner_args, $context, $args ) {

		$banner_args['type'] = get_theme_mod( 'ignite_theme_banner_front_page', '' );

		$banner_args['context'] = 'front_page';

		$post_type = get_post_type();

		if ( ! empty( $post_type ) ) {

			$banner_args['post_type'] = $post_type;

			$banner_args['context'] = 'front-page';

			$banner_args['classes'][] = 'is-front-page';

		} //  End if

		// Legacy check for old banner settings
		if ( empty( $banner_args['type'] ) ) {

			$banner_args['type'] = get_theme_mod( '_cahnrswp_ignite_fronpage_feature', '' );

		} // End if

		return $banner_args;

	} // End get_banner_data_front_page


	protected function get_banner_data_taxonomy( $banner_args, $context, $args ) {

		$banner_args['context'] = 'taxonomy';

		$term = get_queried_object();

		if ( ! empty( $term ) ) {

			$banner_args['classes'][] = $term->taxonomy;

			$banner_args['classes'][] = $term->slug;

			$banner_args['term_slug'] = $term->slug;

		} // End if

		return $banner_args;

	} // End get_banner_data_taxonomy

} // End Ignite_Banners

$ignite_banners = new Ignite_Banners();
