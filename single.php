<?php

ignite_get_part( 'header', 'single' );

do_action( 'ignite_theme_banner', 'single', array() );

/*require_once CAHNRSIGNITEPATH . 'theme-parts/page-banners/class-page-banner-cahnrs-ignite.php';
$page_banner = new Page_Banner_CAHNRS_Ignite();
$page_banner->the_banner( 'single' );*/

require_once CAHNRSIGNITEPATH . 'theme-parts/secondary-menu/class-secondary-menu-ignite.php';
$secondary_menu = new Secondary_Menu_Ignite();
$secondary_menu->the_menu( 'single' );

ob_start();

require locate_template( 'includes/content/single.php', false );

$html = ob_get_clean();

echo apply_filters( 'cahnrs_ignite_page_html', $html );

ignite_get_part( 'footer', 'front-page' );
