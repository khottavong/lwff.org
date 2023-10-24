<?php

if ( ! function_exists( 'firstframe_core_add_portfolio_category_list_variation_gallery' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_portfolio_category_list_variation_gallery( $variations ) {
		$variations['gallery'] = esc_html__( 'Gallery', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_portfolio_category_list_layouts', 'firstframe_core_add_portfolio_category_list_variation_gallery' );
}
