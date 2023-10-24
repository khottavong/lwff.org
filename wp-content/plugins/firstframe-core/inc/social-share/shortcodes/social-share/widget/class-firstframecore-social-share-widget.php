<?php

if ( ! function_exists( 'firstframe_core_add_social_share_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function firstframe_core_add_social_share_widget( $widgets ) {
		$widgets[] = 'FirstFrameCore_Social_Share_Widget';

		return $widgets;
	}

	add_filter( 'firstframe_core_filter_register_widgets', 'firstframe_core_add_social_share_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FirstFrameCore_Social_Share_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'firstframe_core_social_share',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'firstframe_core_social_share' );
				$this->set_name( esc_html__( 'FirstFrame Social Share', 'firstframe-core' ) );
				$this->set_description( esc_html__( 'Add a social share element into widget areas', 'firstframe-core' ) );
			}
		}

		public function render( $atts ) {
			echo FirstFrameCore_Social_Share_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
