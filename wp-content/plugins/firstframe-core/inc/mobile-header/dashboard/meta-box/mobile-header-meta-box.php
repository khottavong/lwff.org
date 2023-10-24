<?php

if ( ! function_exists( 'firstframe_core_add_page_mobile_header_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function firstframe_core_add_page_mobile_header_meta_box( $page ) {

		if ( $page ) {
			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-mobile-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Mobile Header Settings', 'firstframe-core' ),
					'description' => esc_html__( 'Mobile header layout settings', 'firstframe-core' ),
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_mobile_header_layout',
					'title'       => esc_html__( 'Mobile Header Layout', 'firstframe-core' ),
					'description' => esc_html__( 'Choose a mobile header layout to set for your website', 'firstframe-core' ),
					'args'        => array( 'images' => true ),
					'options'     => firstframe_core_header_radio_to_select_options( apply_filters( 'firstframe_core_filter_mobile_header_layout_option', array() ) ),
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_mobile_header_in_grid',
					'title'         => esc_html__( 'Content in Grid', 'firstframe-core' ),
					'description'   => esc_html__( 'Set content to be in grid', 'firstframe-core' ),
					'default_value' => '',
					'options'       => firstframe_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			$opener_section = $mobile_header_tab->add_section_element(
				array(
					'name'  => 'qodef_mobile_header_opener_section',
					'title' => esc_html__( 'Mobile Header Opener Styles', 'firstframe-core' ),
				)
			);

			$opener_section_row = $opener_section->add_row_element(
				array(
					'name' => 'qodef_mobile_header_opener_row',
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_mobile_header_opener_color',
					'title'      => esc_html__( 'Color', 'firstframe-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_mobile_header_opener_hover_color',
					'title'      => esc_html__( 'Hover/Active Color', 'firstframe-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_mobile_header_opener_size',
					'title'      => esc_html__( 'Icon Size', 'firstframe-core' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => 'px',
					),
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_page_mobile_header_meta_map', $mobile_header_tab );
		}
	}

	add_action( 'firstframe_core_action_after_general_meta_box_map', 'firstframe_core_add_page_mobile_header_meta_box' );
}

if ( ! function_exists( 'firstframe_core_add_general_mobile_header_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function firstframe_core_add_general_mobile_header_meta_box_callback( $callbacks ) {
		$callbacks['mobile-header'] = 'firstframe_core_add_page_mobile_header_meta_box';

		return $callbacks;
	}

	add_filter( 'firstframe_core_filter_general_meta_box_callbacks', 'firstframe_core_add_general_mobile_header_meta_box_callback' );
}
