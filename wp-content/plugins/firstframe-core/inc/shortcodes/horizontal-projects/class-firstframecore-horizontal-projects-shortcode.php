<?php

if ( ! function_exists( 'firstframe_core_add_horizontal_projects_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function firstframe_core_add_horizontal_projects_shortcode( $shortcodes ) {
		$shortcodes[] = 'FirstFrameCore_Horizontal_Projects_Shortcode';

		return $shortcodes;
	}

	add_filter( 'firstframe_core_filter_register_shortcodes', 'firstframe_core_add_horizontal_projects_shortcode' );
}

if ( class_exists( 'FirstFrameCore_Shortcode' ) ) {
	class FirstFrameCore_Horizontal_Projects_Shortcode extends FirstFrameCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( FIRSTFRAME_CORE_SHORTCODES_URL_PATH . '/horizontal-projects' );
			$this->set_base( 'firstframe_core_horizontal_projects' );
			$this->set_name( esc_html__( 'Horizontal Projects', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays horizontal projects', 'firstframe-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'cta_title',
					'title'      => esc_html__( 'CTA Title', 'firstframe-core' ),
					'group'      => esc_html__( 'Call To Action', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'cta_widget_area',
					'title'      => esc_html__( 'CTA Widget Area', 'firstframe-core' ),
					'options'    => array_merge(
						array(
							'' => ''
						),
						firstframe_core_get_custom_sidebars()
					),
					'group'      => esc_html__( 'Call To Action', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Project Items', 'firstframe-core' ),
					'items'      => array(
						array(
							'field_type' => 'text',
							'name'       => 'item_label_first',
							'title'      => esc_html__( 'Label First', 'firstframe-core' ),
						),
							array(
							'field_type' => 'text',
							'name'       => 'item_label_second',
							'title'      => esc_html__( 'Label Second', 'firstframe-core' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'item_title',
							'title'      => esc_html__( 'Title', 'firstframe-core' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'item_category',
							'title'      => esc_html__( 'Category', 'firstframe-core' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'item_category_link',
							'title'      => esc_html__( 'Category Link', 'firstframe-core' ),
						),
						array(
							'field_type' => 'image',
							'name'       => 'item_image',
							'title'      => esc_html__( 'Image', 'firstframe-core' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'item_link',
							'title'      => esc_html__( 'Link', 'firstframe-core' ),
						),
						array(
							'field_type'    => 'select',
							'name'          => 'item_target',
							'title'         => esc_html__( 'Link Target', 'firstframe-core' ),
							'options'       => firstframe_core_get_select_type_options_pool( 'link_target' ),
							'default_value' => '_self'
						),
					),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'firstframe_core_horizontal_projects', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['this_shortcode'] = $this;

			return firstframe_core_get_template_part( 'shortcodes/horizontal-projects', 'templates/horizontal-projects', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-horizontal-projects';

			return implode( ' ', $holder_classes );
		}
	}
}
