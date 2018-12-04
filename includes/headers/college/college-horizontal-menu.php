<?php

$classes = array();

$is_mobile = get_theme_mod( 'cahnrswsuwp_ignite_make_mobile_header_horizontal', false );

$has_dividers = get_theme_mod( '_cahnrswp_header_horizontal_nav_show_divider', false );

if ( $has_dividers ) {

	$classes[] = 'has-dividers';

} // End if

if ( $is_mobile ) {

	$classes[] = 'is-mobile';

} // End if

?>
<nav id="college-header-horiz-menu" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
<?php if ( ! empty( $is_mobile ) ) : ?><a href="#main-menu" class="toggle-menu">Open menu</a><?php endif; ?>
	<?php echo wp_kses_post( wp_nav_menu( array( 'menu' => get_theme_mod( '_cahnrswp_header_horizontal_nav', 0 ), 'theme_location' => 'header_horizontal' ) ) ); ?>
</nav>
