<?php

class Scripts_CAHNRS_Ignite {


	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		add_action('wp_footer', array( $this, 'wp_enqueue_scripts_footer'));

	} // end __construct


	public function wp_enqueue_scripts() {

		wp_enqueue_script( 'ignite-js', CAHNRSIGNITEURL . 'js/ignite.js', array( 'jquery' ), Functions_Ignite::$version, true );

		wp_enqueue_style( 'font-awesome', CAHNRSIGNITEURL . 'font-awesome/css/font-awesome.min.css', array(), Functions_Ignite::$version );

		wp_enqueue_script( 'vimeo', 'https://player.vimeo.com/api/player.js', array(), Functions_Ignite::$version );

	} // end wp_enqueue_scripts

	public function wp_enqueue_scripts_footer(){

		wp_enqueue_script( 'cahnrs-js', CAHNRSIGNITEURL . 'js/cahnrs-ignite.js', array( 'jquery' ), Functions_Ignite::$version, true );
	
	}


	public function admin_enqueue_scripts() {

		wp_enqueue_style( 'admin-css', CAHNRSIGNITEURL . 'css/admin.css', array(), Functions_Ignite::$version );

	} // end wp_enqueue_scripts


} // end Sidebars_CAHNRS_Ignite

$scripts_cahnrs_ignite = new Scripts_CAHNRS_Ignite();
