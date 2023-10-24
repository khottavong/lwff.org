<?php

if ( ! function_exists( 'firstframe_core_add_team_list_variation_image_rounded' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_team_list_variation_image_rounded( $variations ) {
		$variations['image-rounded'] = esc_html__( 'Image Rounded', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_team_list_layouts', 'firstframe_core_add_team_list_variation_image_rounded' );
}

if ( ! function_exists( 'firstframe_core_add_team_list_options_image_rounded' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function firstframe_core_add_team_list_options_image_rounded( $options ) {
		$image_rounded_options   = array();
		$margin_option        = array(
			'field_type' => 'text',
			'name'       => 'image_rounded_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'firstframe-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'image-rounded',
						'default_value' => 'default',
					),
				),
			),
			'group'      => esc_html__( 'Layout', 'firstframe-core' ),
		);
		$image_rounded_options[] = $margin_option;

		return array_merge( $options, $image_rounded_options );
	}

	add_filter( 'firstframe_core_filter_team_list_extra_options', 'firstframe_core_add_team_list_options_image_rounded' );
}
