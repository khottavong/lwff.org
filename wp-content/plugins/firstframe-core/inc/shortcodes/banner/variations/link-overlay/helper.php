<?php

if ( ! function_exists( 'firstframe_core_add_banner_variation_link_overlay' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_banner_variation_link_overlay( $variations ) {
		$variations['link-overlay'] = esc_html__( 'Link Overlay', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_banner_layouts', 'firstframe_core_add_banner_variation_link_overlay' );
}
