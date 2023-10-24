<?php

if ( ! function_exists( 'firstframe_core_add_interactive_info_box_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function firstframe_core_add_interactive_info_box_shortcode( $shortcodes ) {
		$shortcodes[] = 'FirstFrameCore_InteractiveInfoBox_Shortcode';

		return $shortcodes;
	}

	add_filter( 'firstframe_core_filter_register_shortcodes', 'firstframe_core_add_interactive_info_box_shortcode' );
}

if ( class_exists( 'FirstFrameCore_Shortcode' ) ) {
	class FirstFrameCore_InteractiveInfoBox_Shortcode extends FirstFrameCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'firstframe_core_filter_interactive_info_box_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'firstframe_core_filter_interactive_info_box_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( FIRSTFRAME_CORE_SHORTCODES_URL_PATH . '/interactive-info-box' );
			$this->set_base( 'firstframe_core_interactive_info_box' );
			$this->set_name( esc_html__( 'Interactive Info Box', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds awards list element', 'firstframe-core' ) );
			$this->set_category( esc_html__( 'Zermatt Core', 'firstframe-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'firstframe-core' ),
				)
			);

			$options_map = firstframe_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'layout',
					'title'         => esc_html__( 'Layout', 'firstframe-core' ),
					'options'       => $this->get_layouts(),
					'default_value' => $options_map['default_value'],
					'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_tag',
					'title'         => esc_html__( 'Title Tag', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => 'h3',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'link_target',
					'title'         => esc_html__( 'Link Target', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self'
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'skin',
					'title'      => esc_html__( 'Skin', 'firstframe-core' ),
					'options'    => array(
						''      => esc_html__( 'Default', 'firstframe-core' ),
						'light' => esc_html__( 'Light', 'firstframe-core' ),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Child elements', 'firstframe-core' ),
					'items'      => array(
					array(
							'field_type' => 'text',
							'name'       => 'text_1',
							'title'      => esc_html__( 'Text 1', 'firstframe-core' )
						),
							array(
							'field_type' => 'text',
							'name'       => 'text_2',
							'title'      => esc_html__( 'Text 2', 'firstframe-core' )
						),
						array(
							'field_type' => 'text',
							'name'       => 'title',
							'title'      => esc_html__( 'Title', 'firstframe-core' )
						),
						array(
							'field_type' => 'text',
							'name'       => 'text_description',
							'title'      => esc_html__( 'Description', 'firstframe-core' )
						),
						array(
							'field_type'    => 'text',
							'name'          => 'link',
							'title'         => esc_html__( 'Link 1', 'firstframe-core' ),
							'default_value' => ''
						),
						array(
							'field_type'    => 'text',
							'name'          => 'link_2',
							'title'         => esc_html__( 'Link 2', 'firstframe-core' ),
							'default_value' => ''
						),
						array(
							'field_type' => 'image',
							'name'       => 'image',
							'title'      => esc_html__( 'Image', 'firstframe-core' ),
							'multiple'   => 'no'
						),
					)
				)
			);
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'firstframe_core_interactive_info_box', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['this_shortcode'] = $this;

			return firstframe_core_get_template_part( 'shortcodes/interactive-info-box', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-interactive-info-box qodef-grid qodef-layout--columns qodef-gutter--no';
			$holder_classes[] = isset( $atts['layout'] ) && ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = isset( $atts['skin'] ) && ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}
