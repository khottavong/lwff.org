<?php

if ( ! function_exists( 'firstframe_core_add_tabs_variation_simple' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_tabs_variation_simple( $variations ) {
		$variations['simple'] = esc_html__( 'Simple', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_tabs_layouts', 'firstframe_core_add_tabs_variation_simple' );
}
