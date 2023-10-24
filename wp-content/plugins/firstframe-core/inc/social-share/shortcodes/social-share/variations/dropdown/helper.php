<?php

if ( ! function_exists( 'firstframe_core_add_social_share_variation_dropdown' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_social_share_variation_dropdown( $variations ) {
		$variations['dropdown'] = esc_html__( 'Dropdown', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_social_share_layouts', 'firstframe_core_add_social_share_variation_dropdown' );
	add_filter( 'firstframe_core_filter_social_share_layout_options', 'firstframe_core_add_social_share_variation_dropdown' );
}
