<?php

if ( ! function_exists( 'firstframe_core_add_blog_list_variation_minimal' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_blog_list_variation_minimal( $variations ) {
		$variations['minimal'] = esc_html__( 'Minimal', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_blog_list_layouts', 'firstframe_core_add_blog_list_variation_minimal' );
	add_filter( 'firstframe_core_filter_simple_blog_list_widget_layouts', 'firstframe_core_add_blog_list_variation_minimal' );
}
