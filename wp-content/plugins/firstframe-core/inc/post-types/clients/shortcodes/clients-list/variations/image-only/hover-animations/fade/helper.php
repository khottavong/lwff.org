<?php

if ( ! function_exists( 'firstframe_core_filter_clients_list_image_only_fade' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_filter_clients_list_image_only_fade( $variations ) {
		$variations['fade'] = esc_html__( 'Fade', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_clients_list_image_only_animation_options', 'firstframe_core_filter_clients_list_image_only_fade' );
}
