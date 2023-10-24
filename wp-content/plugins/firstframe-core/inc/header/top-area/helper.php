<?php

if ( ! function_exists( 'firstframe_core_dependency_for_top_area_options' ) ) {
	/**
	 * Function which return dependency values for global module options
	 *
	 * @return array
	 */
	function firstframe_core_dependency_for_top_area_options() {
		return apply_filters( 'firstframe_core_filter_top_area_hide_option', array() );
	}
}

if ( ! function_exists( 'firstframe_core_register_top_area_header_areas' ) ) {
	/**
	 * Function which register widget areas for current module
	 */
	function firstframe_core_register_top_area_header_areas() {
		register_sidebar(
			array(
				'id'            => 'qodef-top-area-left',
				'name'          => esc_html__( 'Header Top Area - Left', 'firstframe-core' ),
				'description'   => esc_html__( 'Widgets added here will appear on the left side in top header area', 'firstframe-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-bar-widget">',
				'after_widget'  => '</div>',
			)
		);

		register_sidebar(
			array(
				'id'            => 'qodef-top-area-right',
				'name'          => esc_html__( 'Header Top Area - Right', 'firstframe-core' ),
				'description'   => esc_html__( 'Widgets added here will appear on the right side in top header area', 'firstframe-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-bar-widget">',
				'after_widget'  => '</div>',
			)
		);
	}

	add_action( 'firstframe_core_action_additional_header_widgets_area', 'firstframe_core_register_top_area_header_areas' );
}

if ( ! function_exists( 'firstframe_core_set_top_area_header_inner_classes' ) ) {
	/**
	 * Function that return classes for top header area
	 * @param array $classes
	 *
	 * @return array
	 */
	function firstframe_core_set_top_area_header_inner_classes( $classes ) {
		$alignment = firstframe_core_get_post_value_through_levels( 'qodef_set_top_area_header_content_alignment' );

		if ( ! empty( $alignment ) ) {
			$classes[] = 'qodef-alignment--' . esc_attr( $alignment );
		}

		return $classes;
	}

	add_filter( 'firstframe_core_filter_top_area_inner_class', 'firstframe_core_set_top_area_header_inner_classes' );
}
