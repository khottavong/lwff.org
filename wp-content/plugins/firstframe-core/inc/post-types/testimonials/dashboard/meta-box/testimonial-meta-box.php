<?php

if ( ! function_exists( 'firstframe_core_add_testimonials_meta_box' ) ) {
	/**
	 * Function that adds fields for testimonials
	 */
	function firstframe_core_add_testimonials_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'testimonials' ),
				'type'  => 'meta',
				'slug'  => 'testimonials',
				'title' => esc_html__( 'Testimonials Parameters', 'firstframe-core' ),
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_testimonials_title',
					'title'      => esc_html__( 'Title', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'textarea',
					'name'       => 'qodef_testimonials_text',
					'title'      => esc_html__( 'Text', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_testimonials_author',
					'title'      => esc_html__( 'Author', 'firstframe-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_testimonials_author_job',
					'title'      => esc_html__( 'Author Job Title', 'firstframe-core' ),
				)
			);
			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_testimonials_rating',
					'title'         => esc_html__( 'Rating', 'firstframe-core' ),
					'options'       => array(
						'0' => esc_html__( '0', 'firstframe-core' ),
						'1' => esc_html__( '1', 'firstframe-core' ),
						'2' => esc_html__( '2', 'firstframe-core' ),
						'3'   => esc_html__( '3', 'firstframe-core' ),
						'4'   => esc_html__( '4', 'firstframe-core' ),
						'5'   => esc_html__( '5', 'firstframe-core' ),
					),
					'default_value' => '0'
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_testimonials_meta_box_map', $page );
		}
	}

	add_action( 'firstframe_core_action_default_meta_boxes_init', 'firstframe_core_add_testimonials_meta_box' );
}
