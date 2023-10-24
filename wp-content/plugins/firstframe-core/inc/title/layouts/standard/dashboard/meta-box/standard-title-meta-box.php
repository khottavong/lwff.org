<?php

if ( ! function_exists( 'firstframe_core_add_standard_title_layout_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function firstframe_core_add_standard_title_layout_meta_box( $page ) {

		if ( $page ) {
			$section = $page->add_section_element(
				array(
					'name'       => 'qodef_standard_title_section',
					'title'      => esc_html__( 'Standard Title', 'firstframe-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_title_layout' => array(
								'values'        => array( '', 'standard' ),
								'default_value' => '',
							),
						),
					),
				)
			);

			$section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_page_title_subtitle',
					'title'      => esc_html__( 'Subtitle', 'firstframe-core' ),
				)
			);

			$section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_page_title_subtitle_color',
					'title'      => esc_html__( 'Subtitle Color', 'firstframe-core' ),
				)
			);

			$section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_page_title_subtitle_top_margin',
					'title'      => esc_html__( 'Subtitle Top Margin', 'firstframe-core' ),
					'args'       => array(
						'suffix' => esc_html__( 'px', 'firstframe-core' ),
					),
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_standard_title_layout_meta_box_map', $section );
		}
	}

	add_action( 'firstframe_core_action_after_page_title_meta_box_map', 'firstframe_core_add_standard_title_layout_meta_box' );
}
