<?php

if ( ! function_exists( 'firstframe_core_add_icon_with_text_variation_before_title' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_icon_with_text_variation_before_title( $variations ) {
		$variations['before-title'] = esc_html__( 'Before Title', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_icon_with_text_layouts', 'firstframe_core_add_icon_with_text_variation_before_title' );
}
