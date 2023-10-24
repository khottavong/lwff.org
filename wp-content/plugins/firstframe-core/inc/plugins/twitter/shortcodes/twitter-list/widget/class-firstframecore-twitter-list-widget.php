<?php

if ( ! function_exists( 'firstframe_core_add_twitter_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function firstframe_core_add_twitter_list_widget( $widgets ) {
		if ( qode_framework_is_installed( 'twitter' ) ) {
			$widgets[] = 'FirstFrameCore_Twitter_List_Widget';
		}

		return $widgets;
	}

	add_filter( 'firstframe_core_filter_register_widgets', 'firstframe_core_add_twitter_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FirstFrameCore_Twitter_List_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_widget_option(
				array(
					'name'       => 'widget_title',
					'field_type' => 'text',
					'title'      => esc_html__( 'Title', 'firstframe-core' ),
				)
			);
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'firstframe_core_twitter_list',
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'firstframe_core_twitter_list' );
				$this->set_name( esc_html__( 'FirstFrame Twitter List', 'firstframe-core' ) );
				$this->set_description( esc_html__( 'Add a twitter list element into widget areas', 'firstframe-core' ) );
			}
		}

		public function render( $atts ) {
			echo FirstFrameCore_Twitter_List_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
