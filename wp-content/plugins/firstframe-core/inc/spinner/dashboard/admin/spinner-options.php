<?php

if ( ! function_exists( 'firstframe_core_add_page_spinner_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function firstframe_core_add_page_spinner_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_spinner',
					'title'         => esc_html__( 'Enable Page Spinner', 'firstframe-core' ),
					'description'   => esc_html__( 'Enable Page Spinner Effect', 'firstframe-core' ),
					'default_value' => 'no',
				)
			);

			$spinner_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_spinner_section',
					'title'      => esc_html__( 'Page Spinner Section', 'firstframe-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_page_spinner' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							),
						),
					),
				)
			);

			$spinner_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_spinner_type',
					'title'         => esc_html__( 'Select Page Spinner Type', 'firstframe-core' ),
					'description'   => esc_html__( 'Choose a page spinner animation style', 'firstframe-core' ),
					'options'       => apply_filters( 'firstframe_core_filter_page_spinner_layout_options', array() ),
					'default_value' => apply_filters( 'firstframe_core_filter_page_spinner_default_layout_option', '' ),
				)
			);

			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_background_color',
					'title'       => esc_html__( 'Spinner Background Color', 'firstframe-core' ),
					'description' => esc_html__( 'Choose the spinner background color', 'firstframe-core' ),
				)
			);

			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_color',
					'title'       => esc_html__( 'Spinner Color', 'firstframe-core' ),
					'description' => esc_html__( 'Choose the spinner color', 'firstframe-core' ),
				)
			);

            $spinner_section->add_field_element(
                array(
                    'field_type'    => 'text',
                    'name'          => 'qodef_page_spinner_text',
                    'title'         => esc_html__( 'Spinner Text', 'firstframe-core' ),
                    'description'   => esc_html__( 'Enter the spinner text', 'firstframe-core' ),
                    'default_value' => 'firstframe',
                    'dependency'    => array(
                        'show' => array(
                            'qodef_page_spinner_type' => array(
                                'values'        => array('textual','predefined'),
                                'default_value' => ''
                            )
                        )
                    )
                )
            );

			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_text_color',
					'title'       => esc_html__( 'Spinner Text Color', 'firstframe-core' ),
					'description' => esc_html__( 'Choose the spinner text color', 'firstframe-core' ),
					'dependency'    => array(
						'show' => array(
							'qodef_page_spinner_type' => array(
								'values'        => array('predefined'),
								'default_value' => ''
							)
						)
					)
				)
			);

			$spinner_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_page_spinner_fade_out_animation',
					'title'         => esc_html__( 'Enable Fade Out Animation', 'firstframe-core' ),
					'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'firstframe-core' ),
					'default_value' => 'no',
				)
			);
		}
	}

	add_action( 'firstframe_core_action_after_general_options_map', 'firstframe_core_add_page_spinner_options' );
}
