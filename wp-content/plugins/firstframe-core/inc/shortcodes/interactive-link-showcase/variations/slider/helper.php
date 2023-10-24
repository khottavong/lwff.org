<?php

if ( ! function_exists( 'firstframe_core_add_interactive_link_showcase_variation_slider' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_interactive_link_showcase_variation_slider( $variations ) {
		$variations['slider'] = esc_html__( 'Slider', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_interactive_link_showcase_layouts', 'firstframe_core_add_interactive_link_showcase_variation_slider' );
}
