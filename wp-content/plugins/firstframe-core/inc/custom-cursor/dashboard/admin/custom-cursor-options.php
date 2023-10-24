<?php

if ( ! function_exists( 'firstframe_core_custom_cursor_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function firstframe_core_custom_cursor_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => FIRSTFRAME_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'custom-cursor',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'Custom Cursor', 'firstframe-core' ),
				'description' => esc_html__( 'Global Sidebar Options', 'firstframe-core' ),
			)
		);

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_custom_cursor',
					'title'         => esc_html__( 'Enable Custom Cursor', 'firstframe-core' ),
					'description'   => esc_html__( 'Use this option to enable custom cursor', 'firstframe-core' ),
					'default_value' => 'yes',
				)
			);

			$custom_cursor_section = $page->add_section_element(
				array(
					'name'       => 'qodef_custom_cursor_section',
					'title'      => esc_html__( 'Custom Cursor Area', 'firstframe-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_custom_cursor' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							),
						),
					),
				)
			);

			$custom_cursor_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_custom_cursor_layout',
					'title'       => esc_html__( 'Layout', 'firstframe-core' ),
					'description' => esc_html__( 'Choose a predefined stylization for custom cursor', 'firstframe-core' ),
					'options'     => array(
						'circle' => esc_html__( 'Circle', 'firstframe-core' ),
					),
				)
			);


			$custom_cursor_dot_section = $custom_cursor_section->add_section_element(
				array(
					'name'       => 'qodef_custom_cursor_dot_section',
					'title'      => esc_html__( 'Custom Cursor', 'firstframe-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_custom_cursor_layout' => array(
								'values'        => 'circle',
								'default_value' => 'circle',
							),
						),
					),
				)
			);

			$custom_cursor_dot_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_custom_cursor_color',
					'title'       => esc_html__( 'Color', 'firstframe-core' ),
				)
			);


			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_custom_cursor_options_map', $page );
		}
	}

	add_action( 'firstframe_core_action_default_options_init', 'firstframe_core_custom_cursor_options', firstframe_core_get_admin_options_map_position( 'custom-cursor' ) );
}
