<?php

class Ignite_Subtitle_Module {

public function __construct() {


    add_action( 'edit_form_after_title', array( $this, 'add_subtitle_settings' ), 9 );

    add_action( 'save_post_page', array( $this, 'save_post' ), 10, 3 );

}


public function add_subtitle_settings( $post ) {

    if ( 'page' === $post->post_type ) {

        $post_id = $post->ID;

        $html = $this->get_edit_form( $post_id );

        echo $html;
        

    } // End if

} // End add_feature_settings

protected function get_edit_form( $post_id ) {

    

    $subtitle = get_post_meta( $post_id, '_page_subtitle', true );

    $html = '';

    ob_start();

    include __DIR__ . '/editor.php';

    $html .= ob_get_clean();

    return $html;

} // End get_data_edit_form


public function save_post( $post_id, $post, $update ) {

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

        return;

    }

    if ( ! current_user_can( 'edit_posts' ) ) {

        return;

    }

    // TO DO: Sanitize / Nonce this

            
        if ( isset( $_POST[ '_page_subtitle' ] ) ) {

            $val = $_POST[ '_page_subtitle' ];

            update_post_meta( $post_id, '_page_subtitle', $val );

        } // End if
    

} // End save_post

}
$ignite_subtitle_module = new Ignite_Subtitle_Module();
