<?php
/**
 * Custom functionality required by your child theme can go here. Use this
 * to override any defaults provided by the Spine parent theme through
 * the provided actions and filters.
 */

class Functions_Ignite {

	public static $version = '2.2.19';

	public function __construct() {

		define( 'CAHNRSIGNITEPATH', get_stylesheet_directory() . '/' );

		define( 'CAHNRSIGNITEURL', get_stylesheet_directory_uri() . '/' );

		require_once __DIR__ . '/lib/functions/global-functions.php';

		$this->init_theme_functions();

	} // end __construct


	protected function init_theme_functions() {

		require_once __DIR__ . '/classes/class-theme-setup-cahnrs-ignite.php';

		require_once __DIR__ . '/classes/class-theme-part-ignite.php';

		require_once __DIR__ . '/classes/class-scripts-cahnrs-ignite.php';

		require_once __DIR__ . '/classes/class-customizer-cahnrs-ignite.php';

		require_once __DIR__ . '/classes/class-css-cahnrs-ignite.php';

		require_once __DIR__ . '/classes/class-post-editor-cahnrs-ignite.php';

		require_once __DIR__ . '/includes/menus-cahnrswsuwp-ignite.php';

		$this->add_feature_banners();

		$this->add_modules();

		$this->add_sidebars();

		$this->add_post_types();

		$this->add_shortcodes();

		$this->add_menus();

		$this->add_taxonomies();

		$this->add_customizer_controls();

		$this->add_post_formats();

		add_action( 'widgets_init', array( $this, 'add_widgets' ) );

	} // end init_theme_functions


	protected function add_feature_banners() {

		require_once __DIR__ . '/lib/theme-parts/feature-banner/class-feature-banner.php';

	} // End add_feature_banners


	protected function add_modules() {

		require_once __DIR__ . '/lib/modules/subtitle/ignite_subtitle_module.php';


	}


	protected function add_shortcodes() {

		require_once __DIR__ . '/lib/shortcodes/class-shortcode-cahnrs-ignite.php';

		require_once __DIR__ . '/lib/shortcodes/cahnrs-news/class-cahnrs-news-shortcode-ignite.php';

		require_once __DIR__ . '/lib/shortcodes/cahnrs-search/class-cahnrs-search-shortcode-ignite.php';

		require_once __DIR__ . '/lib/shortcodes/theme-part/class-cahnrs-theme-part-shortcode-ignite.php';

		require_once __DIR__ . '/lib/shortcodes/cahnrs-events/class-cahnrs-events-shortcode-ignite.php';

		require_once __DIR__ . '/lib/shortcodes/cahnrs-publications/class-cahnrs-publications-shortcode-ignite.php';

		require_once __DIR__ . '/lib/shortcodes/cahnrs-posts/class-cahnrs-posts-shortcode-ignite.php';

		require_once __DIR__ . '/lib/shortcodes/cwpinsert/class-cwpinsert-shortcode-ignite.php';

		require_once __DIR__ . '/lib/shortcodes/cwpaccordions/class-cwpaccordion-shortcode-ignite.php';

	} // End add_shortcodes


	protected function add_post_types() {

		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );

		require_once __DIR__ . '/lib/post-types/class-post-type-ignite.php';

		require_once __DIR__ . '/lib/post-types/articles/class-articles-post-type-cahnrs-ignite.php';

		// Removed
		//require_once __DIR__ . '/lib/post-types/news-release/class-news-release-post-type-cahnrs-ignite.php';

		require_once __DIR__ . '/lib/post-types/theme-parts/class-theme-part-post-type-cahnrs-ignite.php';

		require_once __DIR__ . '/lib/post-types/publications/class-publications-post-type-cahnrs-ignite.php';

		require_once __DIR__ . '/lib/post-types/slides/class-slide-post-type-ignite.php';

		require_once __DIR__ . '/lib/post-types/videos/class-video-post-type-ignite.php';

		require_once __DIR__ . '/lib/post-types/degrees/class-degree-post-type-ignite.php';

		require_once __DIR__ . '/lib/post-types/indexed-content/class-indexed-content-post-type-ignite.php';

		require_once __DIR__ . '/lib/post-types/web-publication/class-web-publication-post-type-ignite.php';

	} // End add_post_types


	protected function add_sidebars() {

		require_once __DIR__ . '/classes/class-sidebars-cahnrs-ignite.php';

	} // End add_sidebars


	protected function add_menus() {

		require_once __DIR__ . '/classes/class-menus-cahnrs-ignite.php';

	} // End add_menus


	public function add_widgets() {

		require_once __DIR__ . '/widgets/theme-parts/class-theme-part-widget-cahnrs-ignite.php';

		register_widget( 'Theme_Part_Widget_CAHNRS_Ignite' );

	} // End add_widgets


	protected function add_taxonomies() {

		require_once __DIR__ . '/lib/taxonomies/slideshow-category/class-slideshow-category-ignite.php';

	} // End add_taxonomies


	protected function add_customizer_controls() {

		if ( class_exists( 'WP_Customize_Control' ) ) {

			require_once __DIR__ . '/lib/customizer/controls/multi-select/class-customizer-multi-select-control-ignite.php';

		} // End if

	} // End add_customizer_controls


	protected function add_post_formats() {

		require_once __DIR__ . '/lib/post-formats/class-post-formats-ignite.php';

	} // End add_post_formats


} // end Functions_Ignite

$ignite_theme = new Functions_Ignite();
