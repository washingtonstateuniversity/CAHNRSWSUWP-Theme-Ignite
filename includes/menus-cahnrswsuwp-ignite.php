<?php

/**
 * Handle menu tasks for the ignite theme
 *
 * @since 2.1.8
 */

class Menus_CAHNRSWSUWP_Ignite {


	public function __construct() {

		add_filter( 'wp_nav_menu_objects', array( $this, 'make_mobile' ), 10, 2 );

	} // End __construct


	/**
	 * loop through menu items and auto add child link if has children
	 * 
	 * @since 2.1.8
	 * 
	 * @param array $sorted_menu_items Array of Menu objects.
	 * @param array $args Menu args
	 * 
	 * @return array Modified menu array.
	 */
	public function make_mobile( $sorted_menu_items, $args ) {

		// Check if the location is set.
		$location = ( ! empty( $args->theme_location ) ) ? $args->theme_location : false;

		if ( $location ) {

			// This is the key to activate mobile menu in customizer.
			$option_key = 'cahnrswsuwp_ignite_make_mobile_' . $location;

			// Get the setting to check if mobile is enabled.
			$is_mobile = get_theme_mod( $option_key, false );

			if ( $is_mobile ) {

				// Empty array to rebuild the nav.
				$new_array = array();

				// Loop through menu objects.
				foreach ( $sorted_menu_items as $index => $menu_item ) {

					$menu_item->classes[] = 'is-mobile-ready';

					// Get menu item classes.
					$classes = ( isset( $menu_item->classes ) ) ? $menu_item->classes : array();

					// Check if menu item has children.
					if ( is_array( $classes ) && in_array( 'menu-item-has-children', $classes, true ) ) {

						// Add menu item to new array.
						$new_array[] = $menu_item;

						$menu_id = $menu_item->ID;

						// Create a new menu item from the existing one and overwrite properties.
						$new_item = clone $menu_item;
						$new_item->menu_item_parent = $menu_id;
						$new_item->ID = 0;
						$new_item->db_id = 0; // Will cause error if missing.
						$new_item->menu_item_parent = $menu_id;
						$new_item->object_id = 0;
						$new_item->object = 'custom';
						$new_item->type = 'custom';
						$new_item->type_label = 'Custom Link';
						$new_item->classes = array( 'menu-item', 'menu-item-type-custom', 'menu-item-object-custom', 'menu-item-auto-child' );

						if ( in_array( 'current-menu-item', $classes, true ) ) {

							$new_item->classes[] = 'current-menu-item';

						} // End if

						$new_array[] = $new_item;

					} else {

						$new_array[] = $menu_item;

					}// End if
				} // End foreach

				$sorted_menu_items = $new_array;

			} // End if
		} // End if

		return $sorted_menu_items;

	} // End make_mobile

} // End Menus_CAHNRSWSUWP_Ignite

$menus_cahnrswsuwup_ignite = new Menus_CAHNRSWSUWP_Ignite();
