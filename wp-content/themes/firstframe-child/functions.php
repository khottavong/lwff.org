<?php

if ( ! function_exists( 'firstframe_child_theme_enqueue_scripts' ) ) {
	/**
	 * Function that enqueue theme's child style
	 */
	function firstframe_child_theme_enqueue_scripts() {
		$main_style = 'firstframe-main';

		wp_enqueue_style( 'firstframe-child-style', get_stylesheet_directory_uri() . '/style.css', array( $main_style ) );
	}

	add_action( 'wp_enqueue_scripts', 'firstframe_child_theme_enqueue_scripts' );
}
