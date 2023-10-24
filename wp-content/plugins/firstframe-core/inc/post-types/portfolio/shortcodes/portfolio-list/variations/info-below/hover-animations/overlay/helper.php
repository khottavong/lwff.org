<?php

if ( ! function_exists( 'firstframe_core_filter_portfolio_list_info_below_overlay' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_filter_portfolio_list_info_below_overlay( $variations ) {
		$variations['overlay'] = esc_html__( 'Overlay', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_portfolio_list_info_below_animation_options', 'firstframe_core_filter_portfolio_list_info_below_overlay' );
}
