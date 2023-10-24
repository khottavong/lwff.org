<?php

if ( ! function_exists( 'firstframe_core_add_testimonials_list_variation_images_on_the_side' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_testimonials_list_variation_images_on_the_side( $variations ) {
		$variations['images-on-the-side'] = esc_html__( 'Images On The Side', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_testimonials_list_layouts', 'firstframe_core_add_testimonials_list_variation_images_on_the_side' );
}

if ( ! function_exists( 'firstframe_core_add_testimonials_list_options_images_on_the_side' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function firstframe_core_add_testimonials_list_options_images_on_the_side( $options ) {
		$images_on_the_side_options   = array();
		$margin_option                = array(
			'field_type' => 'text',
			'name'       => 'images_on_the_side_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'firstframe-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'images-on-the-side',
						'default_value' => 'default'
					)
				)
			),
			'group'      => esc_html__( 'Layout', 'firstframe-core' )
		);
		$images_on_the_side_options[] = $margin_option;

		return array_merge( $options, $images_on_the_side_options );
	}

	add_filter( 'firstframe_core_filter_testimonials_list_extra_options', 'firstframe_core_add_testimonials_list_options_images_on_the_side' );
}