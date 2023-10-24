<?php

if ( ! function_exists( 'firstframe_core_add_button_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function firstframe_core_add_button_widget( $widgets ) {
		$widgets[] = 'FirstFrameCore_Button_Widget';

		return $widgets;
	}

	add_filter( 'firstframe_core_filter_register_widgets', 'firstframe_core_add_button_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FirstFrameCore_Button_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'firstframe_core_button',
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'firstframe_core_button' );
				$this->set_name( esc_html__( 'FirstFrame Button', 'firstframe-core' ) );
				$this->set_description( esc_html__( 'Add a button element into widget areas', 'firstframe-core' ) );
			}
		}

		public function render( $atts ) {
			echo FirstFrameCore_Button_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
