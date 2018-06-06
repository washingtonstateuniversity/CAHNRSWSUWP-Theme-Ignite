<?php

class Ignite_Dynamic_Scroll_Banner {

	protected $slug = 'dynamic_scroll';

	protected $default_args = array(
		'img'              => '',
		'img_alt'          => '',
		'use_post_image'   => true,
		'inherit_image'    => '',
		'require_image'    => true,
		'height'           => '350px',
		'use_parallax'     => true,
	);


	public function __construct() {

		add_action( 'init', array( $this, 'register_banner' ) );

		add_action( 'ignite_customizer_theme_banners_post_type', array( $this, 'add_customizer' ), 10, 4 );

	} // End __construct


	public function register_banner() {

		$banner_args = array(
			'label' => 'Dynamic Scroll',
			'render_callback'     => array( $this, 'render_banner' ),
			'default_args'        => $this->default_args,
		);

		ignite_register_banner( $this->slug, $banner_args );

	} // End register_banner


	public function render_banner( $context, $args ) {

		$settings = ignite_get_banner_settings( $this->slug, $this->default_args, $args );

		$height = ( ! empty( $settings['height'] ) ) ? $settings['height'] : '300px';

		$parallax = ( ! empty( $settings['use_parallax'] ) ) ? $settings['use_parallax'] : false;

		if ( ! empty( $settings['img'] ) ) {

			$img = $settings['img'];

			include __DIR__ . '/dynamic-scroll.php';

		} // End if

	} // End render_banner


	public function add_customizer( $wp_customize, $section_id, $post_type, $post_type_label ) {

		$base_setting = 'ignite_theme_banner_' . $this->slug . '_' . $post_type . '_';

		$type_setting = 'ignite_theme_banner_' . $post_type;

		foreach ( $this->default_args as $key => $default_value ) {

			$wp_customize->add_setting(
				$base_setting . $key,
				array(
					'default'   => $default_value,
					'transport' => 'refresh',
				)
			);

		} // End foreach

		$wp_customize->add_control(
			$base_setting . 'height_control',
			array(
				'label'      => $post_type_label . ': Banner Height (Include Units)',
				'section'    => $section_id,
				'settings'   => $base_setting . 'height',
				'active_callback' => function() use ( $wp_customize, $type_setting ) {
					$selected_banner = $wp_customize->get_setting( $type_setting )->value();
					return ( 'dynamic_scroll' === $selected_banner ) ? true : false;
				},
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				$base_setting . 'img_control',
				array(
					'label' => $post_type_label . ': Banner Image',
					'section' => $section_id,
					'settings' => $base_setting . 'img',
					'active_callback' => function() use ( $wp_customize, $type_setting ) {
						$selected_banner = $wp_customize->get_setting( $type_setting )->value();
						return ( 'dynamic_scroll' === $selected_banner ) ? true : false;
					},
				)
			)
		);

		$wp_customize->add_control(
			$base_setting . 'img_alt_control',
			array(
				'label'      => $post_type_label . ': Image Alt Text',
				'section'    => $section_id,
				'settings'   => $base_setting . 'img_alt',
				'active_callback' => function() use ( $wp_customize, $type_setting ) {
					$selected_banner = $wp_customize->get_setting( $type_setting )->value();
					return ( 'dynamic_scroll' === $selected_banner ) ? true : false;
				},
			)
		);

		$checkboxes = array(
			'use_post_image'   => 'Use Post Image',
			'inherit_image'    => 'Inherit Image',
			'use_post_title'   => 'Use Post Title',
			'use_parallax'     => 'Use Parallax',
		);

		foreach ( $checkboxes as $setting => $label ) {

			$wp_customize->add_control(
				$base_setting . $setting . '_control',
				array(
					'label'    => $label,
					'section'  => $section_id,
					'settings' => $base_setting . $setting,
					'type'     => 'checkbox',
					'active_callback' => function() use ( $wp_customize, $type_setting ) {
						$selected_banner = $wp_customize->get_setting( $type_setting )->value();
						return ( 'dynamic_scroll' === $selected_banner ) ? true : false;
					},
				)
			); // end control

		} // End foreach */

	} // End add_customizer


} // End Ignite_dynamic_scroll

$ignite_dynamic_scroll = new Ignite_Dynamic_Scroll_Banner();
