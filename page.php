<?php

ignite_get_part( 'header', 'page' );

do_action( 'ignite_theme_banner', 'page', array() );

/*require_once CAHNRSIGNITEPATH . 'theme-parts/page-banners/class-page-banner-cahnrs-ignite.php';
$page_banner = new Page_Banner_CAHNRS_Ignite();
$page_banner->the_banner( 'page' );*/

require_once CAHNRSIGNITEPATH . 'theme-parts/secondary-menu/class-secondary-menu-ignite.php';
$secondary_menu = new Secondary_Menu_Ignite();
$secondary_menu->the_menu( 'page' );

ignite_get_part( 'single-content', 'page' );

ignite_get_part( 'footer', 'page' );
