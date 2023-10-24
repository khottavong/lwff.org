<?php

if ( ! function_exists( 'firstframe_core_add_item_showcase_variation_list' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_item_showcase_variation_list( $variations ) {
		$variations['list'] = esc_html__( 'List', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_item_showcase_layouts', 'firstframe_core_add_item_showcase_variation_list' );
}
