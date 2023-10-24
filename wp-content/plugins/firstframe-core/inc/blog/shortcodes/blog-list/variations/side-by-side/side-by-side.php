<?php

if ( ! function_exists( 'firstframe_core_add_blog_list_variation_side_by_side' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_blog_list_variation_side_by_side( $variations ) {
		$variations['side-by-side'] = esc_html__( 'Side By Side', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_blog_list_layouts', 'firstframe_core_add_blog_list_variation_side_by_side' );
	add_filter( 'firstframe_core_filter_simple_blog_list_widget_layouts', 'firstframe_core_add_blog_list_variation_side_by_side' );
}
