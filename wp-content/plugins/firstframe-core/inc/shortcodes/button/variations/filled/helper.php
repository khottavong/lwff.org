<?php

if ( ! function_exists( 'firstframe_core_add_button_variation_filled' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_button_variation_filled( $variations ) {
		$variations['filled'] = esc_html__( 'Filled', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_button_layouts', 'firstframe_core_add_button_variation_filled' );
}
