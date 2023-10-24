<?php

if ( ! function_exists( 'firstframe_core_add_call_to_action_variation_standard' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_call_to_action_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_call_to_action_layouts', 'firstframe_core_add_call_to_action_variation_standard' );
}
