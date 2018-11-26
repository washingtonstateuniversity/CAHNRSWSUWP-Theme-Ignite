<nav id="college-header-horiz-menu" class="<?php if ( get_theme_mod( '_cahnrswp_header_horizontal_nav_show_divider', 0 ) ) : ?>has-dividers<?php endif; ?>">
	<?php echo wp_kses_post( wp_nav_menu( array( 'menu' => get_theme_mod( '_cahnrswp_header_horizontal_nav', 0 ), 'theme_location' => 'header_horizontal' ) ) ); ?>
</nav>
