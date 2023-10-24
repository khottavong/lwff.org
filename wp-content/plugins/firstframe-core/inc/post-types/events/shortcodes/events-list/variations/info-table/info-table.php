<?php

if ( ! function_exists( 'firstframe_core_add_events_list_variation_info_table' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_events_list_variation_info_table( $variations ) {
		$variations['info-table'] = esc_html__( 'Info Table', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_events_list_layouts', 'firstframe_core_add_events_list_variation_info_table' );
}
