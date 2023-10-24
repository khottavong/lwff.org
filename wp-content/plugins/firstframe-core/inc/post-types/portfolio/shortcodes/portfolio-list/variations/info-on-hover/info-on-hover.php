<?php

if ( ! function_exists( 'firstframe_core_add_portfolio_list_variation_info_on_hover' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_portfolio_list_variation_info_on_hover( $variations ) {
		$variations['info-on-hover'] = esc_html__( 'Info On Hover', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_portfolio_list_layouts', 'firstframe_core_add_portfolio_list_variation_info_on_hover' );
}
