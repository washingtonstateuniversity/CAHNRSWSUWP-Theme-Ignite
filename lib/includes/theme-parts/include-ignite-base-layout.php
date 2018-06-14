<?php

class Ignite_Base_Layout {

	protected $layouts = array(
		'single'      => 'Single Column',
		'column-left' => 'Column Left',
	);

	public function __construct() {

		add_action( 'init', array( $this, 'init_layouts' ) );

		add_action( 'customize_register', array( $this, 'add_customizer_settings' ) );

	} // end __construct


	/**
	 * Init layout functionality if set in customizer
	 */
	public function init_layouts() {

		$use_layouts = get_theme_mod( 'ignite_use_layouts', false );

		if ( $use_layouts ) {

			add_filter( 'ignite_post_content_single_html', array( $this, 'get_base_layout' ), 10, 3 );

			add_action( 'ignite-layout-column-sidebar-before', array( $this, 'get_column_navigation' ), 10, 1 );

			add_action( 'add_meta_boxes', array( $this, 'add_menu_meta_box' ), 10, 2 );

			add_action( 'save_post', array( $this, 'save_menu_metabox' ) );

		} // End if

	} // End init_layouts


	/**
	 * Add Customizer section, settings, & controls
	 * @since 2.1.1
	 *
	 * @param WP_Customize
	 */
	public function add_customizer_settings( $wp_customize ) {

		$panel = ignite_get_customizer_panel_slug();

		$section_id = 'ignite_layout_settings';

		$post_types = array(
			'front_page' => 'Front Page',
			'post' => 'Post',
			'page' => 'Page',
		);

		$wp_customize->add_section(
			$section_id,
			array(
				'title' => 'Layout Settings',
				'panel' => $panel,
			)
		); // end add_section

		$wp_customize->add_setting(
			'_cahnrswp_enable_spine_builder',
			array(
				'default'   => 'disable',
				'transport' => 'refresh',
			)
		); // end add_setting

		$wp_customize->add_setting(
			'ignite_use_layouts',
			array(
				'default'   => false,
				'transport' => 'refresh',
			)
		); // end add_setting

		$wp_customize->add_control(
			'_cahnrswp_enable_spine_builder_control',
			array(
				'label'    => 'Spine Layout Builder',
				'section'  => $section_id,
				'settings' => '_cahnrswp_enable_spine_builder',
				'type'     => 'select',
				'choices'  => array(
					'enable'  => 'Enable',
					'disable' => 'Disable',
				),
			)
		); // end control

		$wp_customize->add_control(
			'ignite_use_layouts_control',
			array(
				'label'    => 'Use Theme Layouts',
				'section'  => $section_id,
				'settings' => 'ignite_use_layouts',
				'type'     => 'checkbox',
			)
		); // end control

		$wp_customize->add_setting(
			'ignite_theme_layout_default',
			array(
				'default'   => 'single',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'ignite_theme_layout_default_control',
				array(
					'label'      => 'Default Layout',
					'settings'   => 'ignite_theme_layout_default',
					'section'    => $section_id,
					'type'       => 'select',
					'choices'    => $this->layouts,
					'active_callback' => function() use ( $wp_customize ) {
						$use_layouts = $wp_customize->get_setting( 'ignite_use_layouts' )->value();
						return ( $use_layouts ) ? true : false;
					},
				)
			)
		);

		foreach ( $post_types as $slug => $label ) {

			$wp_customize->add_setting(
				'ignite_theme_layout_' . $slug,
				array(
					'default'   => 'single',
					'transport' => 'refresh',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'ignite_theme_layout_' . $slug . '_control',
					array(
						'label'      => $label . ' Layout',
						'settings'   => 'ignite_theme_layout_' . $slug,
						'section'    => $section_id,
						'type'       => 'select',
						'choices'    => $this->layouts,
						'active_callback' => function() use ( $wp_customize ) {
							$use_layouts = $wp_customize->get_setting( 'ignite_use_layouts' )->value();
							return ( $use_layouts ) ? true : false;
						},
					)
				)
			);

		} // End foreach

	} // End add_customizer_settings


	/**
	 * Wrap content with base layout set from customizer
	 * @since 2.1.1
	 *
	 * @param string $html Content html
	 * @param string $context Context of the html content
	 * @param array $args Args sent along with content request
	 *
	 * @return string HTML for the content
	 */
	public function get_base_layout( $html, $context, $args ) {

		$layout = get_theme_mod( 'ignite_theme_layout_default', 'single' );

		if ( is_front_page() ) {

			$fp_layout = get_theme_mod( 'ignite_theme_layout_front_page', false );

			if ( ! empty( $fp_layout ) ) {

				$layout = $fp_layout;

			} // End if
		} elseif ( is_singular() ) {

			$pt_layout = 'default';

			$post_id = get_the_ID();

			if ( ! empty( $post_id ) ) {

				$pt_layout = get_post_meta( $post_id, '_ignite_page_layout', true );

			} // End if

			if ( empty( $pt_layout ) || 'default' === $pt_layout ) {

				$post_type = get_post_type();

				if ( $post_type ) {

					$pt_layout = get_theme_mod( 'ignite_theme_layout_' . $post_type, false );

				} // End if
			} // End if

			if ( ! empty( $pt_layout ) && 'default' !== $pt_layout ) {

				$layout = $pt_layout;

			} // End if
		} // End if

		switch ( $layout ) {

			case 'column-left':
				$layout_html = $this->get_column_left_layout( $html, $context, $args, $layout );
				$html = $this->get_layout_wrapper( $layout_html, $context, $args );

		} // End switch

		return $html;

	} // End get_base_layout


	/**
	 * Get column left layout option
	 * @since 2.2.1
	 *
	 * @param string $html Content html
	 * @param string $context Context of the html content
	 * @param array $args Args sent along with content request
	 *
	 * @return string HTML for the content
	 */
	protected function get_column_left_layout( $html, $context, $args, $layout ) {

		ob_start();

		include ignite_get_theme_path( 'lib/displays/layouts/column-left.php' );

		return ob_get_clean();

	} // End function get_column_left_layout


	/**
	 * Standard wrap for all layouts
	 * @since 2.2.1
	 *
	 * @param string $html Content html
	 * @param string $context Context of the html content
	 * @param array $args Args sent along with content request
	 *
	 * @return string HTML for the content
	 */
	protected function get_layout_wrapper( $html, $context, $args ) {

		$layout_html = '<div id="ignite-layout-wrapper">';

		$layout_html .= $html;

		$layout_html .= '</div>';

		return $layout_html;

	} // End get_layout_wrapper


	/**
	 * Add navigation to column sidebar
	 * @since 2.1.1
	 *
	 * @param string $layout Current layout context of the sidebar
	 */
	public function get_column_navigation( $layout ) {

		$navigation_html = '';

		if ( is_singular() ) {

			global $post;

			if ( ! empty( $post ) ) {

				$menu_id = $this->get_post_menu_id( $post, $layout );

			} else {

				$menu_id = $this->get_default_menu_id( $post, $layout );

			}// End if
		} else {

			$menu_id = $this->get_default_menu_id( $post, $layout );

		} // End if

		if ( ! empty( $menu_id ) ) {

			if ( is_nav_menu( $menu_id ) ) {

				$menu = wp_get_nav_menu_object( $menu_id );

				$name = $menu->name;

				$class = $menu->slug . '-ignite-column-menu';

				include ignite_get_theme_path( 'lib/displays/menus/sidebar-menus/column-menu.php' );

			} // End if
		} // End if

	} // End add_column_navigation


	/**
	 * Get post set menu
	 * @since 2.1.1
	 *
	 * @param WP_Post $post
	 * @param string $layout Current layout
	 *
	 * @return string Slug for the nav
	 */
	protected function get_post_menu_id( $post, $layout ) {

		$menu_id = get_post_meta( $post->ID, '_ignite_post_menu', true );

		if ( empty( $menu_id ) || 'default' === $menu_id ) {

			$menu_id = $this->get_post_ancestors_menu_id( $post, $layout );

			if ( empty( $menu_id ) || 'default' === $menu_id ) {

				$menu_id = $this->get_default_menu_id( $post, $layout );

			} // End if
		} // End if

		return $menu_id;

	} // End get_post_menu_id


	/**
	 * Get ancestors menu slugs
	 * @since 2.1.1
	 *
	 * @param WP_Post $post
	 * @param string $layout Current layout
	 *
	 * @return string Slug for the nav
	 */
	protected function get_post_ancestors_menu_id( $post, $layout ) {

		$menu_id = '';

		$ancestor_ids = get_post_ancestors( $post );

		foreach ( $ancestor_ids as $id ) {

			$a_menu_id = get_post_meta( $id, '_ignite_post_menu', true );

			if ( ! empty( $a_menu_id ) && 'default' !== $menu_id ) {

				$menu_id = $a_menu_id;

				break;

			} // End if
		} // End foreach;

		return $menu_id;

	} // End get_post_ancestors_menu_id


	/**
	 * Get default set menu
	 * @since 2.1.1
	 *
	 * @param WP_Post $post
	 * @param string $layout Current layout
	 *
	 * @return string Slug for the nav
	 */
	protected function get_default_menu_id( $post, $layout ) {

		$menu_id = 'column-menu';

		return $menu_id;

	} // End get_default_menu_id


	/**
	 * Add menu metabox to edit page
	 * @since 2.1.1
	 *
	 */
	public function add_menu_meta_box( $post_type, $post ) {

		$post_types = array( 'post', 'page' );

		$custom_post_types = get_post_types(
			array(
				'_builtin' => false,
				'public'   => true,
			)
		);

		$post_types = array_merge( $post_types, $custom_post_types );

		add_meta_box(
			'ignite_layout_menu',
			'Layout Options',
			array( $this, 'render_menu_metabox' ),
			$post_types,
			'side',
			'default'
		);

	} // End add_menu_meta_box


	/**
	 * Renders custom layout options metabox
	 * @since 2.1.1
	 *
	 * @param
	 */
	public function render_menu_metabox( $post ) {

		$args = array();

		$default_args = array(
			'_ignite_post_menu'    => 'default',
			'_ignite_page_layout'  => 'default',
		);

		foreach ( $default_args as $key => $default ) {

			$value = get_post_meta( $post->ID, $key, true );

			if ( ! empty( $value ) ) {

				$args[ $key ] = $value;

			} else {

				$args[ $key ] = $default;

			}// End if
		} // End foreach

		$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

		if ( empty( $menus ) || ! is_array( $menus ) ) {

			$menus = array();

		} // End if

		$selected_menu = $args['_ignite_post_menu'];

		$selected_layout = $args['_ignite_page_layout'];

		$layouts = $this->layouts;

		include ignite_get_theme_path( 'lib/displays/forms/layout-options/layout-options-editor.php' );

	} // End render_menu_metabox


	/**
	 * Save layout options metabox
	 */
	public function save_menu_metabox( $post_id ) {

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

			return false;

		} // end if

		if ( ! empty( $_REQUEST['ignite_layout_option'] ) ) {

			check_admin_referer( 'ignite_set_layout_options', 'ignite_layout_option' );

			// Check the user's permissions.
			if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {

				if ( ! current_user_can( 'edit_page', $post_id ) ) {

					wp_nonce_ays();

					die();

				} // end if
			} else {

				if ( ! current_user_can( 'edit_post', $post_id ) ) {

					wp_nonce_ays();

					die();

				} // end if
			} // end if

			$meta_keys = array(
				'_ignite_post_menu',
				'_ignite_page_layout',
			);

			foreach ( $meta_keys as $key ) {

				$value = sanitize_text_field( $_REQUEST[ $key ] );

				if ( ! empty( $value ) ) {

					update_post_meta( $post_id, $key, $value );

				} // End if
			} // End foreach
		} // End if

	} // End save_menu_metabox

} // End Ignite_Base_Layout

$ignite_base_layout = new Ignite_Base_Layout();
