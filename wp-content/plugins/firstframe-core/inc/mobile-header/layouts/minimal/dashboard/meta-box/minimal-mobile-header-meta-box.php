<?php

if ( ! function_exists( 'firstframe_core_add_minimal_mobile_header_meta' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 */
	function firstframe_core_add_minimal_mobile_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_minimal_mobile_header_section',
				'title'      => esc_html__( 'Minimal Mobile Header', 'firstframe-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values'        => 'minimal',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_mobile_header_height',
				'title'       => esc_html__( 'Minimal Height', 'firstframe-core' ),
				'description' => esc_html__( 'Enter header height', 'firstframe-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'firstframe-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_mobile_header_side_padding',
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
				'name'        => 'qodef_minimal_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'firstframe-core' ),
				'description' => esc_html__( 'Enter header background color', 'firstframe-core' ),
			)
		);
	}

	add_action( 'firstframe_core_action_after_page_mobile_header_meta_map', 'firstframe_core_add_minimal_mobile_header_meta', 10, 2 );
}
