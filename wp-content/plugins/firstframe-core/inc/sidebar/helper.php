<?php

if ( ! function_exists( 'firstframe_core_get_main_sidebar_config' ) ) {
	/**
	 * Function that return config variables for main sidebar area
	 *
	 * @return array
	 */
	function firstframe_core_get_main_sidebar_config() {

		// Config variables
		$config = apply_filters(
			'firstframe_core_filter_main_sidebar_config',
			array(
				'title_tag'   => 'h5',
				'title_class' => 'qodef-widget-title',
			)
		);

		return $config;
	}

	add_filter( 'qode_framework_filter_main_sidebar_config', 'firstframe_core_get_main_sidebar_config' );
}

if ( ! function_exists( 'firstframe_core_register_main_sidebar' ) ) {
	/**
	 * Function that registers theme's main sidebar area
	 */
	function firstframe_core_register_main_sidebar() {

		// Sidebar config variables
		$config = firstframe_core_get_main_sidebar_config();

		register_sidebar(
			array(
				'id'            => 'qodef-main-sidebar',
				'name'          => esc_html__( 'Main Sidebar', 'firstframe-core' ),
				'description'   => esc_html__( 'In order to display widgets inside this area you need to set sidebar layout option inside general options or meta box options', 'firstframe-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s" data-area="qodef-main-sidebar">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . esc_attr( $config['title_tag'] ) . ' class="' . esc_attr( $config['title_class'] ) . '">',
				'after_title'   => '</' . esc_attr( $config['title_tag'] ) . '>',
			)
		);
	}

	add_action( 'widgets_init', 'firstframe_core_register_main_sidebar', 1 ); // Permission 1 is set to main sidebar be at the first place
}

if ( ! function_exists( 'firstframe_core_set_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param string $sidebar_name
	 *
	 * @return string
	 */
	function firstframe_core_set_custom_sidebar_name( $sidebar_name ) {
		$option = firstframe_core_get_post_value_through_levels( 'qodef_page_custom_sidebar' );

		if ( ! empty( $option ) ) {
			$sidebar_name = $option;
		}

		return $sidebar_name;
	}

	add_filter( 'firstframe_filter_sidebar_name', 'firstframe_core_set_custom_sidebar_name', 5 ); // permission 5 is set to global option check be at the first place
}

if ( ! function_exists( 'firstframe_core_set_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param string $layout
	 *
	 * @return string
	 */
	function firstframe_core_set_sidebar_layout( $layout ) {
		$option = firstframe_core_get_post_value_through_levels( 'qodef_page_sidebar_layout' );

		if ( ! empty( $option ) ) {
			$layout = $option;
		}

		return $layout;
	}

	add_filter( 'firstframe_filter_sidebar_layout', 'firstframe_core_set_sidebar_layout', 5 ); // permission 5 is set to global option check be at the first place
}

if ( ! function_exists( 'firstframe_core_set_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function firstframe_core_set_sidebar_grid_gutter_classes( $classes ) {
		$option = firstframe_core_get_post_value_through_levels( 'qodef_page_sidebar_grid_gutter' );

		if ( ! empty( $option ) ) {
			$classes = 'qodef-gutter--' . esc_attr( $option );
		}

		return $classes;
	}

	add_filter( 'firstframe_filter_grid_gutter_classes', 'firstframe_core_set_sidebar_grid_gutter_classes', 5 ); // permission 5 is set to global option check be at the first place
}

if ( ! function_exists( 'firstframe_core_set_page_sidebar_widget_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function firstframe_core_set_page_sidebar_widget_styles( $style ) {
		$styles        = array();
		$margin_bottom = firstframe_core_get_option_value( 'admin', 'qodef_page_sidebar_widgets_margin_bottom' );

		if ( ! empty( $margin_bottom ) ) {
			if ( qode_framework_string_ends_with_space_units( $margin_bottom, true ) ) {
				$styles['margin-bottom'] = $margin_bottom;
			} else {
				$styles['margin-bottom'] = intval( $margin_bottom ) . 'px';
			}
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-page-sidebar .widget', $styles );
		}

		return $style;
	}

	add_filter( 'firstframe_filter_add_inline_style', 'firstframe_core_set_page_sidebar_widget_styles' );
}
