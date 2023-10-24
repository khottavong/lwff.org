<?php

if ( ! function_exists( 'firstframe_core_add_blog_list_variation_metro' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_blog_list_variation_metro( $variations ) {
		$variations['metro'] = esc_html__( 'Metro', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_blog_list_layouts', 'firstframe_core_add_blog_list_variation_metro' );
}

if ( ! function_exists( 'firstframe_core_set_blog_list_variation_metro_as_default_layout' ) ) {
	/**
	 * Function that set variation default layout value for this module
	 *
	 * @param string $default_value
	 * @param string $shortcode_base
	 *
	 * @return string
	 */
	function firstframe_core_set_blog_list_variation_metro_as_default_layout( $default_value, $shortcode_base ) {

		if ( 'firstframe_core_blog_list' === $shortcode_base ) {
			$default_value = 'metro';
		}

		return $default_value;
	}

	add_filter( 'firstframe_core_filter_map_layout_options_default_value', 'firstframe_core_set_blog_list_variation_metro_as_default_layout', 10, 2 );
}

if ( ! function_exists( 'firstframe_core_load_blog_list_variation_metro_assets' ) ) {
	/**
	 * Function that return is global blog asses allowed for variation layout
	 *
	 * @param bool $is_enabled
	 * @param array $params
	 *
	 * @return bool
	 */
	function firstframe_core_load_blog_list_variation_metro_assets( $is_enabled, $params ) {

		if ( 'metro' === $params['layout'] ) {
			$is_enabled = true;
		}

		return $is_enabled;
	}

	add_filter( 'firstframe_core_filter_load_blog_list_assets', 'firstframe_core_load_blog_list_variation_metro_assets', 10, 2 );
}

if ( ! function_exists( 'firstframe_core_register_blog_list_metro_scripts' ) ) {
	/**
	 * Function that register modules 3rd party scripts
	 *
	 * @param array $scripts
	 *
	 * @return array
	 */
	function firstframe_core_register_blog_list_metro_scripts( $scripts ) {

		$scripts['wp-mediaelement']    = array(
			'registered' => true,
		);
		$scripts['mediaelement-vimeo'] = array(
			'registered' => true,
		);

		return $scripts;
	}

	add_filter( 'firstframe_core_filter_blog_list_register_scripts', 'firstframe_core_register_blog_list_metro_scripts' );
}

if ( ! function_exists( 'firstframe_core_register_blog_list_metro_styles' ) ) {
	/**
	 * Function that register modules 3rd party scripts
	 *
	 * @param array $styles
	 *
	 * @return array
	 */
	function firstframe_core_register_blog_list_metro_styles( $styles ) {

		$styles['wp-mediaelement'] = array(
			'registered' => true,
		);

		return $styles;
	}

	add_filter( 'firstframe_core_filter_blog_list_register_styles', 'firstframe_core_register_blog_list_metro_styles' );
}
