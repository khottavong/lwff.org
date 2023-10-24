<?php

if ( ! function_exists( 'firstframe_core_generate_events_single_layout' ) ) {
	/**
	 * Function that return default layout for custom post type single page
	 *
	 * @return string
	 */
	function firstframe_core_generate_events_single_layout() {
		$template = 'default';

		return $template;
	}

	add_filter( 'firstframe_core_filter_events_single_layout', 'firstframe_core_generate_events_single_layout' );
}

if ( ! function_exists( 'firstframe_core_generate_events_archive_with_shortcode' ) ) {
	/**
	 * Function that executes events list shortcode with params on archive pages
	 *
	 * @param string $tax - type of taxonomy
	 * @param string $tax_slug - slug of taxonomy
	 */
	function firstframe_core_generate_events_archive_with_shortcode( $tax, $tax_slug ) {
		$params = array();

		$params['additional_params'] = 'tax';
		$params['tax']               = $tax;
		$params['tax_slug']          = $tax_slug;

		echo FirstFrameCore_Events_List_Shortcode::call_shortcode( $params );
	}
}
