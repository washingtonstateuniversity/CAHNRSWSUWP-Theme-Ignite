<?php wp_nonce_field( 'ignite_set_layout_options', 'ignite_layout_option' ); ?>
<p>
	<label for="_ignite_post_menu">Select Menu</label>
	<select name="_ignite_post_menu" style="width:90%" >
		<option value="default" <?php selected( 'default', $selected_menu ); ?>>Inherit from Parent</option>
		<?php foreach ( $menus as $menu ) : ?>
		<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $menu->term_id, $selected_menu ); ?>><?php echo esc_html( $menu->name ); ?></option>
		<?php endforeach; ?>
	</select>
</p>
<p>
	<label for="_ignite_page_layout">Select Layout</label>
	<select name="_ignite_page_layout" style="width:90%" >
		<option value="default" <?php selected( 'default', $selected_layout ); ?>>Default</option>
		<?php foreach ( $layouts as $layout_key => $label ) : ?>
		<option value="<?php echo esc_attr( $layout_key ); ?>" <?php selected( $layout_key, $selected_layout ); ?>><?php echo esc_html( $label ); ?></option>
		<?php endforeach; ?>
	</select>
</p>
<p>
	<label for="_ignite_post_menu_css">Menu CSS Hook</label>
	<input type="text" name="_ignite_post_menu_css" value="<?php echo esc_attr( $css_hook ); ?>" />
</p>
