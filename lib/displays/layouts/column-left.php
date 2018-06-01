<div class="ignite-layout-column column-left lc-column-one">
	<?php do_action( 'ignite-layout-column-sidebar-before', $layout ); ?>
	<?php if ( is_active_sidebar( 'ignite-layout-column-sidebar' ) ) : ?><?php dynamic_sidebar( 'ignite-layout-column-sidebar' ); ?><?php endif; ?>
	<?php do_action( 'ignite-layout-column-sidebar-after', $layout ); ?>
</div>
<div class="ignite-layout-column column-left lc-column-two">
	<?php do_action( 'ignite-layout-column-content-before', $layout ); ?>
	<?php echo $html; ?>
	<?php do_action( 'ignite-layout-column-content-after', $layout ); ?>
</div>
