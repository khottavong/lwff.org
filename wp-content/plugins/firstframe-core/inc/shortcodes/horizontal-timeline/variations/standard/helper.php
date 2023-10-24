<?php

if ( ! function_exists( 'firstframe_core_add_horizontal_timeline_variation_standard' ) ) {
	function firstframe_core_add_horizontal_timeline_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'firstframe-core' );
		
		return $variations;
	}
	
	add_filter( 'firstframe_core_filter_horizontal_timeline_layouts', 'firstframe_core_add_horizontal_timeline_variation_standard' );
}
