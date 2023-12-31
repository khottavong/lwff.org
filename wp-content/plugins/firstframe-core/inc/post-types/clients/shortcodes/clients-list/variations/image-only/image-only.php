<?php

if ( ! function_exists( 'firstframe_core_add_clients_list_variation_image_only' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_clients_list_variation_image_only( $variations ) {
		$variations['image-only'] = esc_html__( 'Image Only', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_clients_list_layouts', 'firstframe_core_add_clients_list_variation_image_only' );
}
