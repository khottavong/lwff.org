<?php

if ( ! function_exists( 'firstframe_core_add_portfolio_single_variation_slider_small' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_portfolio_single_variation_slider_small( $variations ) {
		$variations['slider-small'] = esc_html__( 'Slider - Small', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_portfolio_single_layout_options', 'firstframe_core_add_portfolio_single_variation_slider_small' );
}
