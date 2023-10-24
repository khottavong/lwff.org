<?php

if ( ! function_exists( 'firstframe_core_add_image_with_text_variation_text_on_hover' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_image_with_text_variation_text_on_hover( $variations ) {
		$variations['text-on-hover'] = esc_html__( 'Text On Hover', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_image_with_text_layouts', 'firstframe_core_add_image_with_text_variation_text_on_hover' );
}
