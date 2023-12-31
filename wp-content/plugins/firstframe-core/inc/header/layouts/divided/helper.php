<?php
if ( ! function_exists( 'firstframe_core_add_divided_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */

	function firstframe_core_add_divided_header_global_option( $header_layout_options ) {
		$header_layout_options['divided'] = array(
			'image' => FIRSTFRAME_CORE_HEADER_LAYOUTS_URL_PATH . '/divided/assets/img/divided-header.png',
			'label' => esc_html__( 'Divided', 'firstframe-core' ),
		);

		return $header_layout_options;
	}

	add_filter( 'firstframe_core_filter_header_layout_option', 'firstframe_core_add_divided_header_global_option' );
}


if ( ! function_exists( 'firstframe_core_register_divided_header_layout' ) ) {
	/**
	 * Function which add header layout into global list
	 *
	 * @param array $header_layouts
	 *
	 * @return array
	 */
	function firstframe_core_register_divided_header_layout( $header_layouts ) {
		$header_layout = array(
			'divided' => 'FirstFrameCore_Divided_Header',
		);

		$header_layouts = array_merge( $header_layouts, $header_layout );

		return $header_layouts;
	}

	add_filter( 'firstframe_core_filter_register_header_layouts', 'firstframe_core_register_divided_header_layout' );
}

if ( ! function_exists( 'firstframe_core_register_divided_menu' ) ) {
	/**
	 * Function which add additional main menu navigation into global list
	 *
	 * @param array $menus
	 *
	 * @return array
	 */
	function firstframe_core_register_divided_menu( $menus ) {
		$menus['divided-menu-left-navigation']  = esc_html__( 'Divided Left Navigation', 'firstframe-core' );
		$menus['divided-menu-right-navigation'] = esc_html__( 'Divided Right Navigation', 'firstframe-core' );

		return $menus;
	}

	add_filter( 'firstframe_filter_register_navigation_menus', 'firstframe_core_register_divided_menu' );
}
