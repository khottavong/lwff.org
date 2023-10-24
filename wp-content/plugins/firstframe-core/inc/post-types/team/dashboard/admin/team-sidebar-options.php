<?php

if ( ! function_exists( 'firstframe_core_add_team_archive_sidebar_options' ) ) {
	/**
	 * Function that add sidebar options for team archive module
	 */
	function firstframe_core_add_team_archive_sidebar_options( $tab ) {

		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_team_archive_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'firstframe-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for team archives', 'firstframe-core' ),
					'default_value' => 'no-sidebar',
					'options'       => firstframe_core_get_select_type_options_pool( 'sidebar_layouts', false ),
				)
			);

			$custom_sidebars = firstframe_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_team_archive_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'firstframe-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on team archives', 'firstframe-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_archive_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'firstframe-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'firstframe-core' ),
					'options'     => firstframe_core_get_select_type_options_pool( 'items_space' ),
				)
			);
		}
	}

	add_action( 'firstframe_core_action_after_team_options_archive', 'firstframe_core_add_team_archive_sidebar_options' );
}

if ( ! function_exists( 'firstframe_core_add_team_single_sidebar_options' ) ) {
	/**
	 * Function that add sidebar options for team single module
	 */
	function firstframe_core_add_team_single_sidebar_options( $tab ) {

		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_team_single_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'firstframe-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for team singles', 'firstframe-core' ),
					'default_value' => 'no-sidebar',
					'options'       => firstframe_core_get_select_type_options_pool( 'sidebar_layouts', false ),
				)
			);

			$custom_sidebars = firstframe_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_team_single_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'firstframe-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on team singles', 'firstframe-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_single_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'firstframe-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'firstframe-core' ),
					'options'     => firstframe_core_get_select_type_options_pool( 'items_space' ),
				)
			);
		}
	}

	add_action( 'firstframe_core_action_after_team_options_single', 'firstframe_core_add_team_single_sidebar_options' );
}
