<?php
if ( ! function_exists( 'firstframe_core_add_custom_cursor_body_class' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function firstframe_core_add_custom_cursor_body_class( $classes ) {
		$enable                = firstframe_core_get_post_value_through_levels( 'qodef_enable_custom_cursor' );
		$layout                = firstframe_core_get_post_value_through_levels( 'qodef_custom_cursor_layout' );

		if ( 'yes' === $enable && '' !== $layout ) {
			$classes[] = 'qodef-custom-cursor-enabled';
			$classes[] = 'qodef-custom-cursor-' . $layout;
		}

		return $classes;
	}

	add_filter( 'body_class', 'firstframe_core_add_custom_cursor_body_class' );
}

if ( ! function_exists( 'firstframe_core_load_custom_cursor_layout_template' ) ) {
	/**
	 * Loads custom cursor HTML
	 */
	function firstframe_core_load_custom_cursor_layout_template() {
		$enable = firstframe_core_get_post_value_through_levels( 'qodef_enable_custom_cursor' );
		$layout = firstframe_core_get_post_value_through_levels( 'qodef_custom_cursor_layout' );

		if ( 'yes' === $enable && '' !== $layout ) {
			firstframe_core_template_part( 'custom-cursor/layouts/' . $layout, 'templates/' . $layout );
		}
	}

	add_action( 'firstframe_action_before_wrapper_close_tag', 'firstframe_core_load_custom_cursor_layout_template' );
}

if ( ! function_exists( 'firstframe_core_set_page_custom_cursor_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function firstframe_core_set_page_custom_cursor_styles( $style ) {
		$enable = firstframe_core_get_post_value_through_levels( 'qodef_enable_custom_cursor' );
		$layout = firstframe_core_get_post_value_through_levels( 'qodef_custom_cursor_layout' );

		if ( 'yes' === $enable ) {

			$custom_cursor_styles  = array();
			$custom_cursor_color = firstframe_core_get_post_value_through_levels( 'qodef_custom_cursor_color' );


			if ( ! empty( $custom_cursor_color) ) {
				$custom_cursor_styles['--qode-cursor-color'] = $custom_cursor_color;
			}

			if ( ! empty( $custom_cursor_styles ) ) {
				$style .= qode_framework_dynamic_style( '#qodef-custom-cursor-holder', $custom_cursor_styles );
			}
		}

		return $style;
	}

	add_filter( 'firstframe_filter_add_inline_style', 'firstframe_core_set_page_custom_cursor_styles' );
}
