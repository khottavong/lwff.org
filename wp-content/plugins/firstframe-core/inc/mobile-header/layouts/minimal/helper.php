<?php

if ( ! function_exists( 'firstframe_core_add_minimal_mobile_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 *
	 * @param array $header_layout_options
	 *
	 * @return array
	 */
	function firstframe_core_add_minimal_mobile_header_global_option( $header_layout_options ) {
		$header_layout_options['minimal'] = array(
			'image' => FIRSTFRAME_CORE_MOBILE_HEADER_LAYOUTS_URL_PATH . '/minimal/assets/img/minimal-header.png',
			'label' => esc_html__( 'Minimal', 'firstframe-core' ),
		);

		return $header_layout_options;
	}

	add_filter( 'firstframe_core_filter_mobile_header_layout_option', 'firstframe_core_add_minimal_mobile_header_global_option' );
}

if ( ! function_exists( 'firstframe_core_register_minimal_mobile_header_layout' ) ) {
	/**
	 * This function add header layout into global options list
	 *
	 * @param array $mobile_header_layouts
	 *
	 * @return array
	 */
	function firstframe_core_register_minimal_mobile_header_layout( $mobile_header_layouts ) {
		$mobile_header_layouts['minimal'] = 'FirstFrameCore_Minimal_Mobile_Header';

		return $mobile_header_layouts;
	}

	add_filter( 'firstframe_core_filter_register_mobile_header_layouts', 'firstframe_core_register_minimal_mobile_header_layout' );
}

if ( ! function_exists( 'firstframe_core_minimal_mobile_header_hide_menu_typography' ) ) {
	/**
	 * Function that set dependency option value for specific module layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function firstframe_core_minimal_mobile_header_hide_menu_typography( $options ) {
		$options[] = 'minimal';

		return $options;
	}

	add_filter( 'firstframe_core_filter_mobile_menu_typography_hide_option', 'firstframe_core_minimal_mobile_header_hide_menu_typography' );
}
