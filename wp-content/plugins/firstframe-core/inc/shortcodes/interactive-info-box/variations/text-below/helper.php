<?php

if ( ! function_exists( 'firstframe_core_add_interactive_info_box_variation_text_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_interactive_info_box_variation_text_below( $variations ) {
		$variations['text-below'] = esc_html__( 'Text Below', 'firstframe-core' );
		
		return $variations;
	}
	
	add_filter( 'firstframe_core_filter_interactive_info_box_layouts', 'firstframe_core_add_interactive_info_box_variation_text_below' );
}
