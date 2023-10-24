<?php

if ( ! function_exists( 'firstframe_core_add_single_image_variation_default' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_single_image_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_single_image_layouts', 'firstframe_core_add_single_image_variation_default' );
}
