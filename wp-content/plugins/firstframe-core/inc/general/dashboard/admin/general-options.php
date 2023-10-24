<?php

if ( ! function_exists( 'firstframe_core_add_general_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function firstframe_core_add_general_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_main_color',
					'title'       => esc_html__( 'Main Color', 'firstframe-core' ),
					'description' => esc_html__( 'Choose the most dominant theme color', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_background_color',
					'title'       => esc_html__( 'Page Background Color', 'firstframe-core' ),
					'description' => esc_html__( 'Set background color', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_background_image',
					'title'       => esc_html__( 'Page Background Image', 'firstframe-core' ),
					'description' => esc_html__( 'Set background image', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_repeat',
					'title'       => esc_html__( 'Page Background Image Repeat', 'firstframe-core' ),
					'description' => esc_html__( 'Set background image repeat', 'firstframe-core' ),
					'options'     => array(
						''          => esc_html__( 'Default', 'firstframe-core' ),
						'no-repeat' => esc_html__( 'No Repeat', 'firstframe-core' ),
						'repeat'    => esc_html__( 'Repeat', 'firstframe-core' ),
						'repeat-x'  => esc_html__( 'Repeat-x', 'firstframe-core' ),
						'repeat-y'  => esc_html__( 'Repeat-y', 'firstframe-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_size',
					'title'       => esc_html__( 'Page Background Image Size', 'firstframe-core' ),
					'description' => esc_html__( 'Set background image size', 'firstframe-core' ),
					'options'     => array(
						''        => esc_html__( 'Default', 'firstframe-core' ),
						'contain' => esc_html__( 'Contain', 'firstframe-core' ),
						'cover'   => esc_html__( 'Cover', 'firstframe-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_attachment',
					'title'       => esc_html__( 'Page Background Image Attachment', 'firstframe-core' ),
					'description' => esc_html__( 'Set background image attachment', 'firstframe-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'firstframe-core' ),
						'fixed'  => esc_html__( 'Fixed', 'firstframe-core' ),
						'scroll' => esc_html__( 'Scroll', 'firstframe-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding',
					'title'       => esc_html__( 'Page Content Padding', 'firstframe-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding_mobile',
					'title'       => esc_html__( 'Page Content Padding Mobile', 'firstframe-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_boxed',
					'title'         => esc_html__( 'Boxed Layout', 'firstframe-core' ),
					'description'   => esc_html__( 'Set boxed layout', 'firstframe-core' ),
					'default_value' => 'no',
				)
			);

			$boxed_section = $page->add_section_element(
				array(
					'name'       => 'qodef_boxed_section',
					'title'      => esc_html__( 'Boxed Layout Section', 'firstframe-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_boxed' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_boxed_background_color',
					'title'       => esc_html__( 'Boxed Background Color', 'firstframe-core' ),
					'description' => esc_html__( 'Set boxed background color', 'firstframe-core' ),
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_boxed_background_pattern',
					'title'       => esc_html__( 'Boxed Background Pattern', 'firstframe-core' ),
					'description' => esc_html__( 'Set boxed background pattern', 'firstframe-core' ),
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_boxed_background_pattern_behavior',
					'title'       => esc_html__( 'Boxed Background Pattern Behavior', 'firstframe-core' ),
					'description' => esc_html__( 'Set boxed background pattern behavior', 'firstframe-core' ),
					'options'     => array(
						'fixed'  => esc_html__( 'Fixed', 'firstframe-core' ),
						'scroll' => esc_html__( 'Scroll', 'firstframe-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_passepartout',
					'title'         => esc_html__( 'Passepartout', 'firstframe-core' ),
					'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'firstframe-core' ),
					'default_value' => 'no',
				)
			);

			$passepartout_section = $page->add_section_element(
				array(
					'name'       => 'qodef_passepartout_section',
					'title'      => esc_html__( 'Passepartout Section', 'firstframe-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_passepartout' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_passepartout_color',
					'title'       => esc_html__( 'Passepartout Color', 'firstframe-core' ),
					'description' => esc_html__( 'Choose background color for passepartout', 'firstframe-core' ),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_passepartout_image',
					'title'       => esc_html__( 'Passepartout Background Image', 'firstframe-core' ),
					'description' => esc_html__( 'Set background image for passepartout', 'firstframe-core' ),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size',
					'title'       => esc_html__( 'Passepartout Size', 'firstframe-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout', 'firstframe-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'firstframe-core' ),
					),
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size_responsive',
					'title'       => esc_html__( 'Passepartout Responsive Size', 'firstframe-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'firstframe-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'firstframe-core' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_content_width',
					'title'         => esc_html__( 'Initial Width of Content', 'firstframe-core' ),
					'description'   => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'content_width', false ),
					'default_value' => '1100',
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_general_options_map', $page );

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_custom_js',
					'title'       => esc_html__( 'Custom JS', 'firstframe-core' ),
					'description' => esc_html__( 'Enter your custom JavaScript here', 'firstframe-core' ),
				)
			);
		}
	}

	add_action( 'firstframe_core_action_default_options_init', 'firstframe_core_add_general_options', firstframe_core_get_admin_options_map_position( 'general' ) );
}
