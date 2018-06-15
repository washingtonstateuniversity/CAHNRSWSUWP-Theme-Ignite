<?php

class Ignite_Title_Banner {

	protected $slug = 'title_banner';

	protected $default_args = array(
		'img'              => '',
		'img_alt'          => '',
		'use_post_image'   => '',
		'inherit_image'    => '',
		'require_image'    => true,
		'title'            => '',
		'use_post_title'   => '',
		'inherit_title'    => '',
		'caption'          => '',
		'use_post_caption' => '',
		'inherit_caption'  => '',
		'color'            => '',
		'height'           => '350px',
		'width'            => '',
	);


	public function __construct() {

		add_action( 'init', array( $this, 'register_banner' ) );

		add_action( 'ignite_customizer_theme_banners_post_type', array( $this, 'add_customizer' ), 10, 4 );

	} // End __construct


	public function register_banner() {

		$banner_args = array(
			'label' => 'Title Banner',
			'render_callback'     => array( $this, 'render_banner' ),
			'default_args'        => $this->default_args,
		);

		ignite_register_banner( $this->slug, $banner_args );

	} // End register_banner


	public function render_banner( $context, $args ) {

		$settings = $this->get_banner_settings( $args );

		$title = ( ! empty( $settings['title'] ) ) ? $settings['title'] : '';

		$img = ( ! empty( $settings['img'] ) ) ? $settings['img'] : '';

		$caption = ( ! empty( $settings['caption'] ) ) ? $settings['caption'] : '';

		$height = ( ! empty( $settings['height'] ) ) ? $settings['height'] : '300px';

		$style = array();

		if ( ! empty( $settings['width'] ) ) {

			$style[] = 'max-width:' . $settings['width'];

		} // End if

		$style = implode( ';', $style );

		if ( empty( $settings['require_image'] ) ) {

			include __DIR__ . '/title-banner.php';

		} elseif ( ! empty( $settings['img'] ) ) {

			include __DIR__ . '/title-banner.php';

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
			$base_setting . 'title_control',
			array(
				'label'      => $post_type_label . ': Banner Title',
				'section'    => $section_id,
				'settings'   => $base_setting . 'title',
				'active_callback' => function() use ( $wp_customize, $type_setting ) {
					$selected_banner = $wp_customize->get_setting( $type_setting )->value();
					return ( 'title_banner' === $selected_banner ) ? true : false;
				},
			)
		);

		$wp_customize->add_control(
			$base_setting . 'height_control',
			array(
				'label'      => $post_type_label . ': Banner Height (Include Units)',
				'section'    => $section_id,
				'settings'   => $base_setting . 'height',
				'active_callback' => function() use ( $wp_customize, $type_setting ) {
					$selected_banner = $wp_customize->get_setting( $type_setting )->value();
					return ( 'title_banner' === $selected_banner ) ? true : false;
				},
			)
		);

		$wp_customize->add_control(
			$base_setting . 'width_control',
			array(
				'label'      => $post_type_label . ': Banner Max Width',
				'section'    => $section_id,
				'settings'   => $base_setting . 'width',
				'active_callback' => function() use ( $wp_customize, $type_setting ) {
					$selected_banner = $wp_customize->get_setting( $type_setting )->value();
					return ( 'title_banner' === $selected_banner ) ? true : false;
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
						return ( 'title_banner' === $selected_banner ) ? true : false;
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
					return ( 'title_banner' === $selected_banner ) ? true : false;
				},
			)
		);

		$checkboxes = array(
			'use_post_image'   => 'Use Post Image',
			'inherit_image'    => 'Inherit Image',
			'require_image'    => 'Require Image',
			'use_post_title'   => 'Use Post Title',
			'inherit_title'    => 'Inherit Title',
			'use_post_caption' => 'Use Post Excerpt/Caption',
			'inherit_caption'  => 'Inherit Caption',
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
						return ( 'title_banner' === $selected_banner ) ? true : false;
					},
				)
			); // end control

		} // End foreach

	} // End add_customizer


	protected function get_banner_settings( $args ) {

		$settings = array();

		if ( 'singular' === $args['context'] ) {

			$settings = $this->get_singular_settings( $args );

		} elseif ( 'front-page' === $args['context'] ) {

			$base_key = 'ignite_theme_banner_' . $this->slug . '_front_page';

			if ( ! empty( $args['post_type'] ) ) {

				$settings = $this->get_singular_settings( $args, $base_key );

			} // End if
		} // End if

		$settings = array_merge( $this->default_args, $settings );

		return $settings;

	} // End get_banner_settings


	protected function get_singular_settings( $args, $base_key = false ) {

		$settings = array();

		global $post;

		if ( ! empty( $post ) ) {

			if ( empty( $base_key ) ) {

				$base_key = 'ignite_theme_banner_' . $this->slug . '_' . $post->post_type . '_';

			} else {

				$base_key .= '_';

			} // End if

			foreach ( $this->default_args as $key => $default_value ) {

				$settings[ $key ] = get_theme_mod( $base_key . $key, $default_value );

			} // End foreach

			if ( $settings['use_post_image'] ) {

				$post_image = $this->get_post_image( $post->ID, $settings['inherit_image'] );

				if ( ! empty( $post_image ) ) {

					$settings['img'] = $post_image;

				} // End if
			} // End if

			if ( $settings['use_post_title'] ) {

				$post_title = $this->get_post_title( $post, $settings['inherit_title'] );

				if ( ! empty( $post_title ) ) {

					$settings['title'] = $post_title;

				} // End if
			} // End if

			if ( $settings['use_post_caption'] ) {

				$post_excerpt = $this->get_post_excerpt( $post, $settings['inherit_caption'] );

				if ( ! empty( $post_excerpt ) ) {

					$settings['caption'] = $post_excerpt;

				} // End if
			} // End if
		} // End if

		return $settings;

	} // End get_singular_settings


	protected function get_post_image( $post_id, $use_ancestors = false ) {

		$post_image = '';

		$post_image_array = ignite_get_post_image( $post_id );

		if ( ! empty( $post_image_array ) ) {

			$post_image = $post_image_array['src'];

		} elseif ( $use_ancestors ) {

			$ancestors = get_post_ancestors( $post_id );

			foreach ( $ancestors as $index => $ancestor_id ) {

				$post_image_array = ignite_get_post_image( $ancestor_id );

				if ( ! empty( $post_image_array ) ) {

					$post_image = $post_image_array['src'];

					break;

				} // End if
			} // End foreach
		}// End if

		return $post_image;

	} // End get_post_image


	protected function get_post_title( $post, $use_ancestors = false ) {

		$post_title = $post->post_title;

		if ( $use_ancestors ) {

			$ancestors = get_post_ancestors( $post );

			$parent = reset( $ancestors );

			$post_title = get_the_title( $parent );

		}// End if

		return $post_title;

	} // End get_post_title


	protected function get_post_excerpt( $post, $use_ancestors = false ) {

		$post_excerpt = ignite_get_custom_excerpt( $post );

		if ( $use_ancestors ) {

			$ancestors = get_post_ancestors( $post );

			$parent = reset( $ancestors );

			$parent_post = get_post( $parent );

			$post_excerpt = ignite_get_custom_excerpt( $parent_post );

		} // End if

		return $post_excerpt;

	} // End get_post_title

} // End Ignite_Title_Banner

$ignite_title_banner = new Ignite_Title_Banner();
