<?php wp_nonce_field( 'ignite_set_layout_options','ignite_layout_option' ); ?>
<label for="_ignite_post_menu">Select Menu</label>
<select name="_ignite_post_menu" style="width:90%" >
	<?php echo $menu_options; ?>
</select>
