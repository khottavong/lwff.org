<?php

if ( ! function_exists( 'firstframe_core_add_custom_font_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function firstframe_core_add_custom_font_widget( $widgets ) {
		$widgets[] = 'FirstFrameCore_Custom_Font_Widget';

		return $widgets;
	}

	add_filter( 'firstframe_core_filter_register_widgets', 'firstframe_core_add_custom_font_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FirstFrameCore_Custom_Font_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'firstframe_core_custom_font',
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'firstframe_core_custom_font' );
				$this->set_name( esc_html__( 'FirstFrame Custom Font', 'firstframe-core' ) );
				$this->set_description( esc_html__( 'Add a custom font element into widget areas', 'firstframe-core' ) );
			}
		}

		public function render( $atts ) {
			echo FirstFrameCore_Custom_Font_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
