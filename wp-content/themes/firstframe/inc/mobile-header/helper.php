<?php

if ( ! function_exists( 'firstframe_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function firstframe_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'firstframe_filter_mobile_header_template', firstframe_get_template_part( 'mobile-header', 'templates/mobile-header' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	add_action( 'firstframe_action_page_header_template', 'firstframe_load_page_mobile_header' );
}

if ( ! function_exists( 'firstframe_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function firstframe_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'firstframe_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'firstframe' ) ) );

		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}

	add_action( 'firstframe_action_after_include_modules', 'firstframe_register_mobile_navigation_menus' );
}
