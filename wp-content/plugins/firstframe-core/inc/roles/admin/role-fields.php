<?php

if ( ! function_exists( 'firstframe_core_add_admin_user_options' ) ) {
	/**
	 * Function that add global user options
	 */
	function firstframe_core_add_admin_user_options() {
		$qode_framework                     = qode_framework_get_framework_root();
		$roles_social_scope                 = apply_filters( 'firstframe_core_filter_role_social_array', array(
			'administrator',
			'author'
		) );
		$roles_additional_information_scope = apply_filters( 'firstframe_core_filter_role_additional_information_array', array(
			'administrator',
			'author',
			'subscriber'
		) );
		$page2                              = $qode_framework->add_options_page(
			array(
				'scope' => $roles_additional_information_scope,
				'type'  => 'user',
				'title' => esc_html__( 'Additional Information', 'firstframe-core' ),
				'slug'  => 'admin-additional-information-options',
			)
		);

		if ( $page2 ) {
			$page2->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_additional_information',
					'title'       => esc_html__( 'Additional Information', 'firstframe-core' ),
					'description' => esc_html__( 'Enter additional user information', 'firstframe-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_admin_user_options_map', $page2 );
		}
		$page = $qode_framework->add_options_page(
			array(
				'scope' => $roles_social_scope,
				'type'  => 'user',
				'title' => esc_html__( 'Social Networks', 'firstframe-core' ),
				'slug'  => 'admin-options',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_facebook',
					'title'       => esc_html__( 'Facebook', 'firstframe-core' ),
					'description' => esc_html__( 'Enter user Facebook profile URL', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_instagram',
					'title'       => esc_html__( 'Instagram', 'firstframe-core' ),
					'description' => esc_html__( 'Enter user Instagram profile URL', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_twitter',
					'title'       => esc_html__( 'Twitter', 'firstframe-core' ),
					'description' => esc_html__( 'Enter user Twitter profile URL', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_linkedin',
					'title'       => esc_html__( 'LinkedIn', 'firstframe-core' ),
					'description' => esc_html__( 'Enter user LinkedIn profile URL', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_pinterest',
					'title'       => esc_html__( 'Pinterest', 'firstframe-core' ),
					'description' => esc_html__( 'Enter user Pinterest profile URL', 'firstframe-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_admin_user_options_map', $page );
		}
	}

	add_action( 'firstframe_core_action_register_role_custom_fields', 'firstframe_core_add_admin_user_options' );
}
