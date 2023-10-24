<?php

if ( ! function_exists( 'firstframe_core_add_horizontal_timeline_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function firstframe_core_add_horizontal_timeline_shortcode( $shortcodes ) {
		$shortcodes[] = 'FirstFrameCore_Horizontal_Timeline_Shortcode';

		return $shortcodes;
	}

	add_filter( 'firstframe_core_filter_register_shortcodes', 'firstframe_core_add_horizontal_timeline_shortcode' );
}

if ( class_exists( 'FirstFrameCore_Shortcode' ) ) {
	class FirstFrameCore_Horizontal_Timeline_Shortcode extends FirstFrameCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'firstframe_core_filter_horizontal_timeline_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( FIRSTFRAME_CORE_SHORTCODES_URL_PATH . '/horizontal-timeline' );
			$this->set_base( 'firstframe_core_horizontal_timeline' );
			$this->set_name( esc_html__( 'Horizontal Timeline', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays horizontal timeline with provided parameters', 'firstframe-core' ) );
			$this->set_category( esc_html__( 'PrimeInvest Core', 'firstframe-core' ) );

			$options_map = firstframe_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'firstframe-core' ),
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );

			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'timeline_format',
				'title'         => esc_html__( 'Timeline displays?', 'firstframe-core' ),
				'options'       => array(
					'Y'        => esc_html__( 'Only Years', 'firstframe-core' ),
					'M Y'      => esc_html__( 'Years and Months', 'firstframe-core' ),
					'M d, \'y' => esc_html__( 'Years, Months and Days', 'firstframe-core' ),
					'M d'      => esc_html__( 'Months and Days', 'firstframe-core' ),
				),
				'default_value' => 'Y',
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'distance',
				'title'         => esc_html__( 'Minimal Distance Between Dates?', 'firstframe-core' ),
				'description'   => esc_html__( 'Default value is 60', 'firstframe-core' ),
				'default_value' => '60',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'slider_drag_cursor',
				'title'         => esc_html__( 'Show Drag Cursor', 'firstframe-core' ),
				'options'       => firstframe_core_get_select_type_options_pool( 'yes_no' ),
				'default_value' => 'no',
			) );

			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Child elements', 'firstframe-core' ),
				'items'      => array(
					array(
						'field_type'  => 'text',
						'name'        => 'item_date',
						'title'       => esc_html__( 'Timeline Date', 'firstframe-core' ),
						'description' => esc_html__( 'Enter date in format mm/dd/yyyy.', 'firstframe-core' )
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image',
						'title'      => esc_html__( 'Image', 'valiance-core' ),
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_title',
						'title'      => esc_html__( 'Title', 'valiance-core' )
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_subtitle',
						'title'      => esc_html__( 'Subtitle', 'valiance-core' )
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_text',
						'title'      => esc_html__( 'Text', 'valiance-core' )
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image_second',
						'title'      => esc_html__( 'Second Small Image', 'valiance-core' ),
					),

				)
			) );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'firstframe_core_horizontal_timeline', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['this_object']    = $this;

			return firstframe_core_get_template_part( 'shortcodes/horizontal-timeline', 'variations/' . $atts['layout'] . '/templates/horizontal-timeline', '', $atts );
		}


		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-horizontal-timeline';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			if ( isset( $atts['slider_drag_cursor'] ) && 'yes' === $atts['slider_drag_cursor'] ) {
				$holder_classes[] = 'qodef--drag-cursor';
			}

			return implode( ' ', $holder_classes );
		}

		public function getItemClasses( $item ) {
			$itemClasses = array();

			$itemClasses[] = ! empty( $item['item_image'] ) ? 'qodef-hr-timeline-has-image' : 'qodef-hr-timeline-no-image';

			return implode( ' ', $itemClasses );
		}
	}
}
