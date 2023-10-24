<?php

if ( ! function_exists( 'firstframe_core_add_text_marquee_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function firstframe_core_add_text_marquee_widget( $widgets ) {
		$widgets[] = 'FirstFrameCore_Text_Marquee_Widget';

		return $widgets;
	}

	add_filter( 'firstframe_core_filter_register_widgets', 'firstframe_core_add_text_marquee_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FirstFrameCore_Text_Marquee_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'firstframe_core_text_marquee',
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'firstframe_core_text_marquee' );
				$this->set_name( esc_html__( 'Text Marquee', 'firstframe-core' ) );
				$this->set_description( esc_html__( 'Add a text marquee element into widget areas', 'firstframe-core' ) );
			}
		}

		public function render( $atts ) {
			echo FirstFrameCore_Text_Marquee_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
