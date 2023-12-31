<?php

if ( ! function_exists( 'firstframe_core_add_yith_quick_view_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 */
	function firstframe_core_add_yith_quick_view_options( $page ) {

		if ( $page ) {

			if ( qode_framework_is_installed( 'yith-quick-view' ) ) {

				$yith_quick_view_tab = $page->add_tab_element(
					array(
						'name'        => 'tab-yith-quick-view',
						'icon'        => 'fa fa-cog',
						'title'       => esc_html__( 'YITH Quick View', 'firstframe-core' ),
						'description' => esc_html__( 'Settings related to YITH Quick View', 'firstframe-core' ),
					)
				);

				$yith_quick_view_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_woo_yith_quick_view_title_tag',
						'title'       => esc_html__( 'Title Tag', 'firstframe-core' ),
						'description' => esc_html__( 'Choose title tag for YITH Quick View item', 'firstframe-core' ),
						'options'     => firstframe_core_get_select_type_options_pool( 'title_tag' ),
					)
				);

				$yith_quick_view_tab->add_field_element(
					array(
						'field_type'    => 'yesno',
						'name'          => 'qodef_enable_woo_yith_quick_view_predefined_style',
						'title'         => esc_html__( 'Enable Predefined Style', 'firstframe-core' ),
						'description'   => esc_html__( 'Enabling this option will set predefined style for YITH Quick View plugin', 'firstframe-core' ),
						'options'       => firstframe_core_get_select_type_options_pool( 'no_yes', false ),
						'default_value' => 'yes',
					)
				);
			}
		}
	}

	add_action( 'firstframe_core_action_after_woo_options_map', 'firstframe_core_add_yith_quick_view_options' );
}
