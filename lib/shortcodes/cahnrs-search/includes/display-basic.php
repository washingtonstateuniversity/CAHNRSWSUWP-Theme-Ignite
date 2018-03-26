<form class="cahnrs-search-shortcode <?php echo esc_html( $atts['display'] ); ?>-display" <?php if ( $atts['results_url'] ) : ?>action="<?php echo esc_url( $atts['results_url'] ); ?>"<?php endif; ?>>
	<div class="inner-wrapper">
		<?php foreach ( $atts as $key => $value ) : ?>
			<div><?php if ( $value && ! in_array( $key, $exclude, true ) ) : ?><input type="hidden" name="ci-<?php echo esc_html( $key ); ?>" value="<?php echo esc_html( $value ); ?>" /><?php endif; ?></div>
		<?php endforeach; ?>
		<div class="cahnrs-search-field ci-keyword-field">
			<input type="text" name="<?php echo esc_html( $keyword_name ); ?>" value="" placeholder="Search"/>
		</div>
		<div class="cahnrs-search-field ci-submit-field">
			<button type="submit">Go</button>
		</div>
	</div>
</form>
