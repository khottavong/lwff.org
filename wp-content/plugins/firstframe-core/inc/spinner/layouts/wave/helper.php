<?php

if ( ! function_exists( 'firstframe_core_add_wave_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function firstframe_core_add_wave_spinner_layout_option( $layouts ) {
		$layouts['wave'] = esc_html__( 'Wave', 'firstframe-core' );

		return $layouts;
	}

	add_filter( 'firstframe_core_filter_page_spinner_layout_options', 'firstframe_core_add_wave_spinner_layout_option' );
}
