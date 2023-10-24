<?php

if ( ! function_exists( 'firstframe_core_add_social_share_variation_text' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_social_share_variation_text( $variations ) {
		$variations['text'] = esc_html__( 'Text', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_social_share_layouts', 'firstframe_core_add_social_share_variation_text' );
	add_filter( 'firstframe_core_filter_social_share_layout_options', 'firstframe_core_add_social_share_variation_text' );
}
