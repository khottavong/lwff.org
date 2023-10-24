<?php

if ( ! function_exists( 'firstframe_core_add_banner_variation_link_button' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_banner_variation_link_button( $variations ) {
		$variations['link-button'] = esc_html__( 'Link Button', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_banner_layouts', 'firstframe_core_add_banner_variation_link_button' );
}
