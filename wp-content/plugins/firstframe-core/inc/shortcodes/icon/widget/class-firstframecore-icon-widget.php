<?php

if ( ! function_exists( 'firstframe_core_add_icon_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function firstframe_core_add_icon_widget( $widgets ) {
		$widgets[] = 'FirstFrameCore_Icon_Widget';

		return $widgets;
	}

	add_filter( 'firstframe_core_filter_register_widgets', 'firstframe_core_add_icon_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FirstFrameCore_Icon_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'firstframe_core_icon',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'firstframe_core_icon' );
				$this->set_name( esc_html__( 'FirstFrame Icon', 'firstframe-core' ) );
				$this->set_description( esc_html__( 'Add a icon element into widget areas', 'firstframe-core' ) );
			}
		}

		public function render( $atts ) {
			echo FirstFrameCore_Icon_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
