<?php

if ( ! function_exists( 'firstframe_core_add_image_marquee_variation_default' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_image_marquee_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_image_marquee_layouts', 'firstframe_core_add_image_marquee_variation_default' );
}
