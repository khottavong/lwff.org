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

function blog_list_events_display( $args, $atts, $post_type ) {
	if ( $atts[ 'custom_class' ] = 'events-list' ) {
		$args[ 'post_type' ] = 'event-item';
	}
	return $args;
}
add_filter( 'qi_addons_for_elementor_filter_additional_query_args', 'blog_list_events_display', 10, 3 );
