<?php
/*
Plugin Name: Particles JS Widget
Plugin URI: https://github.com/JordiMatamales/particles-js-widget/blob/master/README.md
Description: A Wordpress plugin to display particles.js library using a widget.
Version: 1.0.0
Author: Jordi Matamales
Author URI: http://jordimatamales.com
*/

//* Prevent direct access to the plugin
if ( ! defined( 'ABSPATH' ) ) {
    die( __( 'Sorry, you are not allowed to access this page directly.', 'particles-js-widget' ) );
}

define( 'PARTICLES_JS_WIDGET_FOLDER', dirname( __FILE__ ) . '/lib/' );

//* Register Widget
function particles_js_widget() {
	register_widget( 'Particles_js_widget' );
}
add_action( 'widgets_init', 'particles_js_widget' );

class Particles_js_widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_particles_js', 'description' => __( 'Lists current section subpages', 'particles-js-widget' ) );
		parent::__construct( 'particles_js_widget', __( 'Particles JS Widget', 'particles-js-widget' ), $widget_ops );
	}
	
	//* Display particles
	public function widget( $args, $instance ) {

		// Echo the particles div
		echo "<!-- particles.js container -->
		<div id='particles-js'></div>";

		//* Enqueue necessary files
		$url = preg_replace( '/^https?:/', '', plugins_url( '/', __FILE__ ) );
		wp_register_script( 'particles-library', $url . '/js/particles.min.js', array( 'jquery' ), '0.1.0');
		wp_register_script( 'particles-app', $url . '/js/app.js', array( 'jquery' ), '0.1.0');
		wp_register_style(  'particles-css', $url . '/style.css', array(), '0.1.0');
		
		wp_enqueue_script( 'particles-library' );
		wp_enqueue_script( 'particles-app' );
		wp_enqueue_style(  'particles-css' );

	}
}