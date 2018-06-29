<?php $keyword = ( ! empty( $_GET['s'] )) ? sanitize_text_field( $_GET['s'] ) : ''; ?>
<div class="cahnrs-ignite-search-form basic-search-form">
	<form id="ignite-search-form">
		<div class="ignite-search-form-field ignite-search-form-field-keyword">
			<label for="ignite-search-form-keyword">Keyword</label>
			<input id="ignite-search-form-keyword" type="text" value="<?php echo esc_html( $keyword ); ?>" name="s" placeholder="Search" />
		</div>
		<div class="ignite-search-form-field ignite-search-form-field-submit">
			<button type="submit">Search</button>
		</div>
	</form>
</div>
