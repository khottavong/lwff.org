<?php

if ( ! function_exists( 'firstframe_core_add_page_sidebar_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function firstframe_core_add_page_sidebar_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => FIRSTFRAME_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'sidebar',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'Sidebar', 'firstframe-core' ),
				'description' => esc_html__( 'Global Sidebar Options', 'firstframe-core' ),
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'firstframe-core' ),
					'description'   => esc_html__( 'Choose a default sidebar layout for pages', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'sidebar_layouts', false ),
					'default_value' => 'no-sidebar',
				)
			);

			$custom_sidebars = firstframe_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$page->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_page_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'firstframe-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on pages', 'firstframe-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'firstframe-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'firstframe-core' ),
					'options'     => firstframe_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_sidebar_widgets_margin_bottom',
					'title'       => esc_html__( 'Widgets Margin Bottom', 'firstframe-core' ),
					'description' => esc_html__( 'Set space value between widgets', 'firstframe-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_page_sidebar_options_map', $page );
		}
	}

	add_action( 'firstframe_core_action_default_options_init', 'firstframe_core_add_page_sidebar_options', firstframe_core_get_admin_options_map_position( 'sidebar' ) );
}
