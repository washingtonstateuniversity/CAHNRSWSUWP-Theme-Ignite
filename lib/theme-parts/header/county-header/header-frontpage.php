<?php 

// @codingStandardsIgnoreStart These are already escaped 
echo ignite_get_template_header();
echo ignite_get_template_main();
// @codingStandardsIgnoreEnd

?><header id="site-header" class="county-theme">
	<div class="site-header-inner">
		<nav class="site-nav">
<a href="https://cahnrs.wsu.edu">CAHNRS</a><a href="https://extension.wsu.edu">EXTENSION</a><?php if ( ! is_front_page() ) : ?><a class="is-this-site" href="<?php echo esc_url( $site_url ); ?>"><?php echo esc_html( $site_title ); ?></a><?php endif; ?>
		</nav>
		<?php if ( is_front_page() ) : ?><div class="site-title">
			<a href="<?php echo esc_url( $site_url ); ?>"><?php echo esc_html( $site_title ); ?></a>
		</div><?php endif; ?>
	</div>
</header>
<nav id="site-actions" class="county-theme">
	<?php echo wp_kses_post( ignite_get_sidebar( 'site-actions', array( 'wrap' => '' ) ) ); ?>
</nav>
