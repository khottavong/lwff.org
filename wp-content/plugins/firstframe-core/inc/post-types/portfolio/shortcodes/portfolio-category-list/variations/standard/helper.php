<?php

if ( ! function_exists( 'firstframe_core_add_portfolio_category_list_variation_standard' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_portfolio_category_list_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_portfolio_category_list_layouts', 'firstframe_core_add_portfolio_category_list_variation_standard' );
}
