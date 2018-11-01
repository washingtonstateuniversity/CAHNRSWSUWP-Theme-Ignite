<div class="ignite-post-editor">
    <div class="ignite-field-set">
        <h2>Subtitle</h2>
        <div class="ignite-field text-field">
        <label>Subtitle: <span>(Optional)</span></label>
        <input type="text" name="_page_subtitle" value="<?php echo esc_html( $subtitle ); ?>" />
        </div>
    </div>
</div>
<?php wp_nonce_field( 'add_subtitle', 'subtitle_nonce' ); ?>
