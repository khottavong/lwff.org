<?php

if ( ! function_exists( 'firstframe_core_add_standard_header_meta' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function firstframe_core_add_standard_header_meta( $page ) {
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_standard_header_section',
				'title'      => esc_html__( 'Standard Header', 'firstframe-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => array( '', 'standard' ),
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_in_grid',
				'title'         => esc_html__( 'Content in Grid', 'firstframe-core' ),
				'description'   => esc_html__( 'Set content to be in grid', 'firstframe-core' ),
				'default_value' => '',
				'options'       => firstframe_core_get_select_type_options_pool( 'no_yes' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
				'title'       => esc_html__( 'Header Height', 'firstframe-core' ),
				'description' => esc_html__( 'Enter header height', 'firstframe-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'firstframe-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'firstframe-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'firstframe-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'firstframe-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'firstframe-core' ),
				'description' => esc_html__( 'Enter header background color', 'firstframe-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'firstframe-core' ),
				'description' => esc_html__( 'Enter header border color', 'firstframe-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_border_width',
				'title'       => esc_html__( 'Header Border Width', 'firstframe-core' ),
				'description' => esc_html__( 'Enter header border width size', 'firstframe-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'firstframe-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_standard_header_border_style',
				'title'       => esc_html__( 'Header Border Style', 'firstframe-core' ),
				'description' => esc_html__( 'Choose header border style', 'firstframe-core' ),
				'options'     => firstframe_core_get_select_type_options_pool( 'border_style' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'firstframe-core' ),
				'default_value' => '',
				'options'       => array(
					''       => esc_html__( 'Default', 'firstframe-core' ),
					'left'   => esc_html__( 'Left', 'firstframe-core' ),
					'center' => esc_html__( 'Center', 'firstframe-core' ),
					'right'  => esc_html__( 'Right', 'firstframe-core' ),
				),
			)
		);
	}

	add_action( 'firstframe_core_action_after_page_header_meta_map', 'firstframe_core_add_standard_header_meta' );
}
