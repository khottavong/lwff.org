<?php

if ( ! function_exists( 'firstframe_core_add_404_page_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function firstframe_core_add_404_page_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => FIRSTFRAME_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => '404',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( '404', 'firstframe-core' ),
				'description' => esc_html__( 'Global 404 Page Options', 'firstframe-core' ),
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_404_page_title',
					'title'         => esc_html__( 'Enable Page Title', 'firstframe-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page title on 404 page', 'firstframe-core' ),
					'default_value' => 'no',
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_404_page_footer',
					'title'         => esc_html__( 'Enable Page Footer', 'firstframe-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page footer on 404 page', 'firstframe-core' ),
					'default_value' => 'yes',
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_404_page_background_color',
					'title'       => esc_html__( 'Background Color', 'firstframe-core' ),
					'description' => esc_html__( 'Enter 404 page area background color', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_404_page_background_image',
					'title'       => esc_html__( 'Background Image', 'firstframe-core' ),
					'description' => esc_html__( 'Enter 404 page area background image', 'firstframe-core' ),
				)
			);
			$page->add_field_element(
				array(
					'field_type'  => 'file',
					'name'        => 'qodef_404_page_background_video',
					'title'       => esc_html__( 'Background Video', 'firstframe-core' ),
					'description' => esc_html__( 'Enter 404 page area background video', 'firstframe-core' ),
					'args'        => array(
						'allowed_type' => '[video/mp4]',
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_404_page_title',
					'title'      => esc_html__( 'Title Label', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_404_page_title_color',
					'title'      => esc_html__( 'Title Color', 'firstframe-core' ),
				)
			);
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_404_page_subtitle',
					'title'      => esc_html__( 'Subtitle Label', 'firstframe-core' ),
				)
			);
			$page->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_404_page_subtitle_color',
					'title'      => esc_html__( 'Subtitle Color', 'firstframe-core' ),
				)
			);
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_404_page_text',
					'title'      => esc_html__( 'Text Label', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_404_page_text_color',
					'title'      => esc_html__( 'Text Color', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_404_page_button_text',
					'title'      => esc_html__( 'Button Text', 'firstframe-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_404_page_options_map', $page );
		}
	}

	add_action( 'firstframe_core_action_default_options_init', 'firstframe_core_add_404_page_options', firstframe_core_get_admin_options_map_position( '404' ) );
}
