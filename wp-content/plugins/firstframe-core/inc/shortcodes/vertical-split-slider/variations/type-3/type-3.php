<?php

if ( ! function_exists( 'firstframe_core_add_vertical_split_slider_variation_type_3' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_vertical_split_slider_variation_type_3( $variations ) {
		$variations['type-3'] = esc_html__( 'Type 3', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_vertical_split_slider_layouts', 'firstframe_core_add_vertical_split_slider_variation_type_3' );
}

if ( ! function_exists( 'firstframe_core_add_vertical_split_slider_options_type_3' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function firstframe_core_add_vertical_split_slider_options_type_3( $options ) {
		$type_3_options            = array();
		$type_3_options_dependency = array(
			'show' => array(
				'slide_content_layout' => array(
					'values'        => 'type-3',
					'default_value' => '',
				),
			),
		);

		$type_3_testimonial_id = array(
			'field_type' => 'select',
			'name'       => 'type_3_id',
			'title'      => esc_html__( 'Testimonial', 'firstframe-core' ),
			'options'    => qode_framework_get_cpt_items( 'testimonials', array( 'numberposts' => '-1' ) ),
			'dependency' => $type_3_options_dependency,
		);
		$type_3_options[]      = $type_3_testimonial_id;

		$type_3_testimonial_skin = array(
			'field_type' => 'select',
			'name'       => 'type_3_skin',
			'title'      => esc_html__( 'Skin', 'firstframe-core' ),
			'options'    => firstframe_core_get_select_type_options_pool( 'shortcode_skin' ),
			'dependency' => $type_3_options_dependency,
		);
		$type_3_options[]        = $type_3_testimonial_skin;

		return array_merge( $options, $type_3_options );
	}

	add_filter( 'firstframe_core_filter_vertical_split_slider_extra_repeater_options', 'firstframe_core_add_vertical_split_slider_options_type_3' );
}
