<?php

if ( ! function_exists( 'firstframe_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function firstframe_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => FIRSTFRAME_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'firstframe-core' ),
				'description' => esc_html__( 'Global Fonts Options', 'firstframe-core' ),
				'icon'        => 'fa fa-cog',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'firstframe-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts',
					),
				)
			);

			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'firstframe-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);

			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts to Include', 'firstframe-core' ),
					'description' => esc_html__( 'Choose Google Fonts which you want to use on your website', 'firstframe-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'firstframe-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type'  => 'googlefont',
					'name'        => 'qodef_choose_google_font',
					'title'       => esc_html__( 'Google Font', 'firstframe-core' ),
					'description' => esc_html__( 'Choose Google Font', 'firstframe-core' ),
					'args'        => array(
						'include' => 'google-fonts',
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Weight', 'firstframe-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts weights for your website. Impact on page load time', 'firstframe-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'firstframe-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'firstframe-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'firstframe-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'firstframe-core' ),
						'300'  => esc_html__( '300 Light', 'firstframe-core' ),
						'300i' => esc_html__( '300 Light Italic', 'firstframe-core' ),
						'400'  => esc_html__( '400 Regular', 'firstframe-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'firstframe-core' ),
						'500'  => esc_html__( '500 Medium', 'firstframe-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'firstframe-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'firstframe-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'firstframe-core' ),
						'700'  => esc_html__( '700 Bold', 'firstframe-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'firstframe-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'firstframe-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'firstframe-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'firstframe-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'firstframe-core' ),
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style', 'firstframe-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts style for your website. Impact on page load time', 'firstframe-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'firstframe-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'firstframe-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'firstframe-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'firstframe-core' ),
						'greek'        => esc_html__( 'Greek', 'firstframe-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'firstframe-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'firstframe-core' ),
					),
				)
			);

			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'firstframe-core' ),
					'description' => esc_html__( 'Add custom fonts', 'firstframe-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'firstframe-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_ttf',
					'title'      => esc_html__( 'Custom Font TTF', 'firstframe-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_otf',
					'title'      => esc_html__( 'Custom Font OTF', 'firstframe-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff',
					'title'      => esc_html__( 'Custom Font WOFF', 'firstframe-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff2',
					'title'      => esc_html__( 'Custom Font WOFF2', 'firstframe-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_custom_font_name',
					'title'      => esc_html__( 'Custom Font Name', 'firstframe-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_page_fonts_options_map', $page );
		}
	}

	add_action( 'firstframe_core_action_default_options_init', 'firstframe_core_add_fonts_options', firstframe_core_get_admin_options_map_position( 'fonts' ) );
}
