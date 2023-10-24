<?php

if ( ! function_exists( 'firstframe_core_add_page_social_share_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function firstframe_core_add_page_social_share_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => FIRSTFRAME_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'social-share',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'Social Share', 'firstframe-core' ),
				'description' => esc_html__( 'Global Social Share Options', 'firstframe-core' ),
				'layout'      => 'tabbed',
			)
		);

		if ( $page ) {
			$social_networks_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-social-networks',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Social Networks Settings', 'firstframe-core' ),
					'description' => esc_html__( 'Social networks settings', 'firstframe-core' ),
				)
			);

			$social_networks = firstframe_core_social_networks_list();

			foreach ( $social_networks as $network => $params ) {
				$social_networks_tab->add_field_element(
					array(
						'field_type'    => 'yesno',
						'name'          => 'qodef_enable_share_' . $network,
						'title'         => sprintf( esc_html__( 'Enable %s Share', 'firstframe-core' ), $params['label'] ),
						'default_value' => 'yes',
					)
				);

				if ( 'twitter' === $network ) {
					$social_networks_tab->add_field_element(
						array(
							'field_type'    => 'text',
							'name'          => 'qodef_twitter_via',
							'title'         => esc_html__( 'Twitter Via Text', 'firstframe-core' ),
							'default_value' => esc_html__( '@QodeInteractive', 'firstframe-core' ),
							'dependency'    => array(
								'show' => array(
									'qodef_enable_share_twitter' => array(
										'values'        => 'yes',
										'default_value' => 'yes',
									),
								),
							),
						)
					);
				}
			}

			$layout_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-social-layout',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Layout Settings', 'firstframe-core' ),
					'description' => esc_html__( 'Social share layout settings', 'firstframe-core' ),
				)
			);

			$layout_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_social_share_layout',
					'title'         => esc_html__( 'Social Share Layout', 'firstframe-core' ),
					'description'   => esc_html__( 'Choose default layout for social share', 'firstframe-core' ),
					'default_value' => apply_filters( 'firstframe_core_filter_social_share_layout_default_value', '' ),
					'options'       => apply_filters( 'firstframe_core_filter_social_share_layout_options', array() ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_social_share_layout_options_map', $layout_tab );

			$cpt_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-social-cpt',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'CPT Settings', 'firstframe-core' ),
					'description' => esc_html__( 'Social share CPT settings', 'firstframe-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_social_share_cpt_options_map', $cpt_tab );

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_social_share_options_map', $page );
		}
	}

	add_action( 'firstframe_core_action_default_options_init', 'firstframe_core_add_page_social_share_options', firstframe_core_get_admin_options_map_position( 'social-share' ) );
}
