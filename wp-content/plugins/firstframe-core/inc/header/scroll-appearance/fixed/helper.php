<?php

if ( ! function_exists( 'firstframe_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function firstframe_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'firstframe-core' );

		return $options;
	}

	add_filter( 'firstframe_core_filter_header_scroll_appearance_option', 'firstframe_core_add_fixed_header_option' );
}
