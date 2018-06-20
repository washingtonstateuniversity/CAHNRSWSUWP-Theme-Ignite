<div class="ignite-layout-column column-left lc-column-one add-mobile-break">
	<?php do_action( 'ignite-layout-column-sidebar-before', $layout ); ?>
	<div class="ignite-sidebar-content"><?php if ( is_active_sidebar( 'sidebar' ) ) : ?><?php dynamic_sidebar( 'sidebar' ); ?><?php endif; ?></div>
	<?php do_action( 'ignite-layout-column-sidebar-after', $layout ); ?>
</div>
<div class="ignite-layout-column column-left lc-column-two add-mobile-break">
	<?php do_action( 'ignite-layout-column-content-before', $layout ); ?>
	<?php echo $html; ?>
	<?php do_action( 'ignite-layout-column-content-after', $layout ); ?>
</div>
