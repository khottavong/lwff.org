<?php

if ( ! function_exists( 'firstframe_core_get_elementor_instance' ) ) {
	/**
	 * Function that return page builder module instance
	 */
	function firstframe_core_get_elementor_instance() {
		return \Elementor\Plugin::instance();
	}
}

if ( ! function_exists( 'firstframe_core_register_new_elementor_widget' ) ) {
	/**
	 * Function that register a new widget type.
	 *
	 * @param \Elementor\Widget_Base $widget_instance Elementor Widget.
	 */
	function firstframe_core_register_new_elementor_widget( $widget_instance ) {

		if ( version_compare( ELEMENTOR_VERSION, '3.5.0', '>' ) ) {
			return firstframe_core_get_elementor_instance()->widgets_manager->register( $widget_instance );
		} else {
			return firstframe_core_get_elementor_instance()->widgets_manager->register_widget_type( $widget_instance );
		}
	}
}

if ( ! function_exists( 'firstframe_core_load_elementor_widgets' ) ) {
	/**
	 * Function that include modules into page builder
	 */
	function firstframe_core_load_elementor_widgets() {
		$check_code = class_exists( 'FirstFrameCore_Dashboard' ) ? FirstFrameCore_Dashboard::get_instance()->get_code() : true;

		if ( ! empty( $check_code ) ) {
			include_once FIRSTFRAME_CORE_PLUGINS_PATH . '/elementor/class-firstframecore-elementor-widget-base.php';

			$widgets = array();
			foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/*', GLOB_ONLYDIR ) as $shortcode ) {

				if ( basename( $shortcode ) !== 'dashboard' ) {
					$is_disabled = firstframe_core_performance_get_option_value( $shortcode, 'firstframe_core_performance_shortcode_' );

					if ( empty( $is_disabled ) ) {
						foreach ( glob( $shortcode . '/*-elementor.php' ) as $shortcode_load ) {
							$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
						}
					}
				}
			}

			foreach ( glob( FIRSTFRAME_CORE_INC_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
				$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
			}

			foreach ( glob( FIRSTFRAME_CORE_CPT_PATH . '/*', GLOB_ONLYDIR ) as $post_type ) {

				if ( 'dashboard' !== basename( $post_type ) ) {
					$is_disabled = firstframe_core_performance_get_option_value( $post_type, 'firstframe_core_performance_post_type_' );

					if ( empty( $is_disabled ) ) {
						foreach ( glob( $post_type . '/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
							$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
						}
					}
				}
			}

			foreach ( glob( FIRSTFRAME_CORE_PLUGINS_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
				$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
			}

			foreach ( glob( FIRSTFRAME_CORE_PLUGINS_PATH . '/*/post-types/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
				$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
			}

			foreach ( glob( FIRSTFRAME_CORE_PLUGINS_PATH . '/*/roles/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
				$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
			}

			if ( ! empty( $widgets ) ) {
				ksort( $widgets );

				foreach ( $widgets as $widget ) {
					include_once $widget;
				}
			}
		}
	}

	if ( version_compare( ELEMENTOR_VERSION, '3.5.0', '>' ) ) {
		add_action( 'elementor/widgets/register', 'firstframe_core_load_elementor_widgets' );
	} else {
		add_action( 'elementor/widgets/widgets_registered', 'firstframe_core_load_elementor_widgets' );
	}
}
