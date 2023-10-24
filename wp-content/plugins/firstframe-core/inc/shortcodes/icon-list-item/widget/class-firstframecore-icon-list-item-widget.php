<?php

if ( ! function_exists( 'firstframe_core_add_icon_list_item_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function firstframe_core_add_icon_list_item_widget( $widgets ) {
		$widgets[] = 'FirstFrameCore_Icon_List_Item_Widget';

		return $widgets;
	}

	add_filter( 'firstframe_core_filter_register_widgets', 'firstframe_core_add_icon_list_item_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FirstFrameCore_Icon_List_Item_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'firstframe_core_icon_list_item',
					'exclude'        => array( 'icon_type', 'custom_icon' ),
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'firstframe_core_icon_list_item' );
				$this->set_name( esc_html__( 'FirstFrame Icon List Item', 'firstframe-core' ) );
				$this->set_description( esc_html__( 'Add a icon list item element into widget areas', 'firstframe-core' ) );
			}
		}

		public function render( $atts ) {
			echo FirstFrameCore_Icon_List_Item_Shortcode::call_shortcode( $atts ); // XSS OK
		}
	}
}
