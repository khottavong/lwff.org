<?php

if ( ! function_exists( 'firstframe_core_add_social_share_variation_list' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_social_share_variation_list( $variations ) {
		$variations['list'] = esc_html__( 'List', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_social_share_layouts', 'firstframe_core_add_social_share_variation_list' );
	add_filter( 'firstframe_core_filter_social_share_layout_options', 'firstframe_core_add_social_share_variation_list' );
}

if ( ! function_exists( 'firstframe_core_set_default_social_share_variation_list' ) ) {
	/**
	 * Function that set default variation layout for this module
	 *
	 * @return string
	 */
	function firstframe_core_set_default_social_share_variation_list() {
		return 'list';
	}

	add_filter( 'firstframe_core_filter_social_share_layout_default_value', 'firstframe_core_set_default_social_share_variation_list' );
}
