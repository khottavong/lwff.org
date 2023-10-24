<?php

if ( ! function_exists( 'firstframe_core_add_interactive_link_showcase_variation_interactive_list' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_interactive_link_showcase_variation_interactive_list( $variations ) {
		$variations['interactive-list'] = esc_html__( 'Interactive List', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_interactive_link_showcase_layouts', 'firstframe_core_add_interactive_link_showcase_variation_interactive_list' );
}
