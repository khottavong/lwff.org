<?php

if ( ! function_exists( 'firstframe_core_add_workflow_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function firstframe_core_add_workflow_shortcode( $shortcodes ) {
		$shortcodes[] = 'FirstFrameCore_Workflow_Shortcode';

		return $shortcodes;
	}

	add_filter( 'firstframe_core_filter_register_shortcodes', 'firstframe_core_add_workflow_shortcode' );
}

if ( class_exists( 'FirstFrameCore_Shortcode' ) ) {
	class FirstFrameCore_Workflow_Shortcode extends FirstFrameCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( FIRSTFRAME_CORE_SHORTCODES_URL_PATH . '/workflow' );
			$this->set_base( 'firstframe_workflow_gallery' );
			$this->set_name( esc_html__( 'Workflow', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds workflow holder', 'firstframe-core' ) );
			$this->set_category( esc_html__( 'FirstFrame Core', 'firstframe-core' ) );
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Workflow Items', 'firstframe-core' ),
					'items'      => array(
						array(
							'field_type'    => 'text',
							'name'          => 'date_range',
							'title'         => esc_html__( 'Date Range', 'firstframe-core' ),
							'default_value' => esc_html__( '1992 - 2001', 'firstframe-core' ),
						),
						array(
							'field_type' => 'textarea',
							'name'       => 'text',
							'title'      => esc_html__( 'Text', 'firstframe-core' ),
						),
					),
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                   = $this->get_atts();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );

			return firstframe_core_get_template_part( 'shortcodes/workflow', 'templates/workflow', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-workflow';

			return implode( ' ', $holder_classes );
		}
	}
}
