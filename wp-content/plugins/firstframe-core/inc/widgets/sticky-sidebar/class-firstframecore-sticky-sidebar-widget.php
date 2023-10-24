<?php

if ( ! function_exists( 'firstframe_core_add_sticky_sidebar_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function firstframe_core_add_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'FirstFrameCore_Sticky_Sidebar_Widget';

		return $widgets;
	}

	add_filter( 'firstframe_core_filter_register_widgets', 'firstframe_core_add_sticky_sidebar_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FirstFrameCore_Sticky_Sidebar_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'firstframe_core_sticky_sidebar' );
			$this->set_name( esc_html__( 'FirstFrame Sticky Sidebar', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Use this widget to make the sidebar sticky. Drag it into the sidebar above the widget which you want to be the first element in the sticky sidebar', 'firstframe-core' ) );
		}

		public function load_assets() {
			wp_enqueue_script( 'gsap' );
		}

		public function render( $atts ) {
		}
	}
}
