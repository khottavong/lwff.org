<?php

if ( ! function_exists( 'firstframe_core_add_author_list_variation_info_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_author_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_author_list_layouts', 'firstframe_core_add_author_list_variation_info_below' );
}
