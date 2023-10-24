<?php

if ( ! function_exists( 'firstframe_core_include_icons' ) ) {
	/**
	 * Function that includes icons
	 */
	function firstframe_core_include_icons() {

		foreach ( glob( FIRSTFRAME_CORE_INC_PATH . '/icons/*/include.php' ) as $icon_pack ) {
			$is_disabled = firstframe_core_performance_get_option_value( dirname( $icon_pack ), 'firstframe_core_performance_icon_pack_' );

			if ( empty( $is_disabled ) ) {
				include_once $icon_pack;
			}
		}
	}

	add_action( 'qode_framework_action_before_icons_register', 'firstframe_core_include_icons' );
}
