<?php

if ( ! function_exists( 'firstframe_core_add_icon_with_text_variation_before_content' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_icon_with_text_variation_before_content( $variations ) {
		$variations['before-content'] = esc_html__( 'Before Content', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_icon_with_text_layouts', 'firstframe_core_add_icon_with_text_variation_before_content' );
}
