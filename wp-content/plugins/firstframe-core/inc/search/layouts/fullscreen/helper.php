<?php

if ( ! function_exists( 'firstframe_core_register_fullscreen_search_layout' ) ) {
	/**
	 * Function that add variation layout into global list
	 *
	 * @param array $search_layouts
	 *
	 * @return array
	 */
	function firstframe_core_register_fullscreen_search_layout( $search_layouts ) {
		$search_layouts['fullscreen'] = 'FirstFrameCore_Fullscreen_Search';

		return $search_layouts;
	}

	add_filter( 'firstframe_core_filter_register_search_layouts', 'firstframe_core_register_fullscreen_search_layout' );
}
