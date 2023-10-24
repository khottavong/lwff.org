<?php

if ( ! function_exists( 'firstframe_core_add_testimonials_list_variation_images_thumb' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_testimonials_list_variation_images_thumb( $variations ) {
		$variations['images-thumb'] = esc_html__( 'Images Thumb', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_testimonials_list_layouts', 'firstframe_core_add_testimonials_list_variation_images_thumb' );
}

if ( ! function_exists( 'firstframe_core_add_testimonials_list_options_images_thumb' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function firstframe_core_add_testimonials_list_options_images_thumb( $options ) {
		$images_thumb_options   = array();
		$margin_option          = array(
			'field_type' => 'text',
			'name'       => 'images_thumb_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'firstframe-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'images-thumb',
						'default_value' => 'default'
					)
				)
			),
			'group'      => esc_html__( 'Layout', 'firstframe-core' )
		);
		$images_thumb_options[] = $margin_option;

		$padding_top_option     = array(
			'field_type' => 'text',
			'name'       => 'images_thumb_content_padding_top',
			'title'      => esc_html__( 'Content Top Padding', 'firstframe-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'images-thumb',
						'default_value' => 'default'
					)
				)
			),
			'group'      => esc_html__( 'Layout', 'firstframe-core' )
		);
		$images_thumb_options[] = $padding_top_option;

		$padding_bottom_option  = array(
			'field_type' => 'text',
			'name'       => 'images_thumb_content_padding_bottom',
			'title'      => esc_html__( 'Content Bottom Padding', 'firstframe-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'images-thumb',
						'default_value' => 'default'
					)
				)
			),
			'group'      => esc_html__( 'Layout', 'firstframe-core' )
		);
		$images_thumb_options[] = $padding_bottom_option;

		return array_merge( $options, $images_thumb_options );
	}

	add_filter( 'firstframe_core_filter_testimonials_list_extra_options', 'firstframe_core_add_testimonials_list_options_images_thumb' );
}