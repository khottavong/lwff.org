<?php

if ( ! function_exists( 'firstframe_core_add_team_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function firstframe_core_add_team_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		$has_single     = firstframe_core_team_has_single();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'team' ),
				'type'  => 'meta',
				'slug'  => 'team',
				'title' => esc_html__( 'Team Single', 'firstframe-core' ),
			)
		);

		if ( $page ) {
			$section = $page->add_section_element(
				array(
					'name'        => 'qodef_team_general_section',
					'title'       => esc_html__( 'General Settings', 'firstframe-core' ),
					'description' => esc_html__( 'General information about team member.', 'firstframe-core' ),
				)
			);

			if ( $has_single ) {
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_team_single_layout',
						'title'       => esc_html__( 'Single Layout', 'firstframe-core' ),
						'description' => esc_html__( 'Choose default layout for team single', 'firstframe-core' ),
						'options'     => array(
							'' => esc_html__( 'Default', 'firstframe-core' ),
						),
					)
				);
			}

			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_role',
					'title'       => esc_html__( 'Role', 'firstframe-core' ),
					'description' => esc_html__( 'Enter team member role', 'firstframe-core' ),
				)
			);

				$social_icons_repeater = $section->add_repeater_element(
				array(
					'name'        => 'qodef_team_member_social_icons',
					'title'       => esc_html__( 'Social Networks', 'firstframe-core' ),
					'description' => esc_html__( 'Populate team member social networks info', 'firstframe-core' ),
					'button_text' => esc_html__( 'Add New Network', 'firstframe-core' ),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_team_member_icon_or_textual',
					'title'         => esc_html__( 'Social network type', 'firstframe-core' ),
					'options'       => array(
						'textual' => esc_html__( 'Textual', 'firstframe-core' ),
						'icon'    => esc_html__( 'Icon', 'firstframe-core' ),
					),
					'default_value' => 'textual',
				)
			);
			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'iconpack',
					'name'       => 'qodef_team_member_icon',
					'title'      => esc_html__( 'Icon', 'firstframe-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_team_member_icon_or_textual' => array(
								'values'        => 'icon',
								'default_value' => '',
							),
						),
					),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_team_member_network_text',
					'title'      => esc_html__( 'Social Network Text', 'firstframe-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_team_member_icon_or_textual' => array(
								'values'        => 'textual',
								'default_value' => '',
							),
						),
					),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_team_member_icon_link',
					'title'      => esc_html__( 'Link', 'firstframe-core' ),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_team_member_icon_target',
					'title'      => esc_html__( 'Target', 'firstframe-core' ),
					'options'    => firstframe_core_get_select_type_options_pool( 'link_target' ),
				)
			);

			if ( $has_single ) {
				$section->add_field_element(
					array(
						'field_type'  => 'date',
						'name'        => 'qodef_team_member_birth_date',
						'title'       => esc_html__( 'Birth Date', 'firstframe-core' ),
						'description' => esc_html__( 'Enter team member birth date', 'firstframe-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'text',
						'name'        => 'qodef_team_member_email',
						'title'       => esc_html__( 'E-mail', 'firstframe-core' ),
						'description' => esc_html__( 'Enter team member e-mail address', 'firstframe-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'text',
						'name'        => 'qodef_team_member_address',
						'title'       => esc_html__( 'Address', 'firstframe-core' ),
						'description' => esc_html__( 'Enter team member address', 'firstframe-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'text',
						'name'        => 'qodef_team_member_education',
						'title'       => esc_html__( 'Education', 'firstframe-core' ),
						'description' => esc_html__( 'Enter team member education', 'firstframe-core' ),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'file',
						'name'        => 'qodef_team_member_resume',
						'title'       => esc_html__( 'Resume', 'firstframe-core' ),
						'description' => esc_html__( 'Upload team member resume', 'firstframe-core' ),
						'args'        => array(
							'allowed_type' => '[application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
						),
					)
				);
			}

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_team_meta_box_map', $page, $has_single );
		}
	}

	add_action( 'firstframe_core_action_default_meta_boxes_init', 'firstframe_core_add_team_single_meta_box' );
}
