<?php

if ( ! function_exists( 'firstframe_core_add_stacked_images_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function firstframe_core_add_stacked_images_shortcode( $shortcodes ) {
		$shortcodes[] = 'FirstFrameCore_Stacked_Images_Shortcode';

		return $shortcodes;
	}

	add_filter( 'firstframe_core_filter_register_shortcodes', 'firstframe_core_add_stacked_images_shortcode' );
}

if ( class_exists( 'FirstFrameCore_Shortcode' ) ) {
	class FirstFrameCore_Stacked_Images_Shortcode extends FirstFrameCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'firstframe_core_filter_stacked_images_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'firstframe_core_filter_stacked_images_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( FIRSTFRAME_CORE_SHORTCODES_URL_PATH . '/stacked-images' );
			$this->set_base( 'firstframe_core_stacked_images' );
			$this->set_name( esc_html__( 'Stacked Images', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image with text element', 'firstframe-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'firstframe-core' ),
				)
			);

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'parallax_item',
					'title'         => esc_html__( 'Enable Parallax Item', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => '',
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
					'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'image',
					'name'       => 'main_image',
					'title'      => esc_html__( 'Main Image', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'images_proportion',
					'default_value' => 'full',
					'title'         => esc_html__( 'Image Proportions', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'list_image_dimension', false ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'custom_image_width',
					'title'       => esc_html__( 'Custom Image Width', 'firstframe-core' ),
					'description' => esc_html__( 'Enter image width in px', 'firstframe-core' ),
					'dependency'  => array(
						'show' => array(
							'images_proportion' => array(
								'values'        => 'custom',
								'default_value' => 'full',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'custom_image_height',
					'title'       => esc_html__( 'Custom Image Height', 'firstframe-core' ),
					'description' => esc_html__( 'Enter image height in px', 'firstframe-core' ),
					'dependency'  => array(
						'show' => array(
							'images_proportion' => array(
								'values'        => 'custom',
								'default_value' => 'full',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Image Items', 'firstframe-core' ),
					'items'      => array(
						array(
							'field_type' => 'image',
							'name'       => 'item_image',
							'title'      => esc_html__( 'Item Image', 'firstframe-core' ),
						),
						array(
							'field_type'    => 'select',
							'name'          => 'images_proportion',
							'default_value' => 'full',
							'title'         => esc_html__( 'Image Proportions', 'firstframe-core' ),
							'options'       => firstframe_core_get_select_type_options_pool( 'list_image_dimension', false ),
						),
						array(
							'field_type'  => 'text',
							'name'        => 'custom_image_width',
							'title'       => esc_html__( 'Custom Image Width', 'firstframe-core' ),
							'description' => esc_html__( 'Enter image width in px', 'firstframe-core' ),
							'dependency'  => array(
								'show' => array(
									'images_proportion' => array(
										'values'        => 'custom',
										'default_value' => 'full',
									),
								),
							),
						),
						array(
							'field_type'  => 'text',
							'name'        => 'custom_image_height',
							'title'       => esc_html__( 'Custom Image Height', 'firstframe-core' ),
							'description' => esc_html__( 'Enter image height in px', 'firstframe-core' ),
							'dependency'  => array(
								'show' => array(
									'images_proportion' => array(
										'values'        => 'custom',
										'default_value' => 'full',
									),
								),
							),
						),
						array(
							'field_type'    => 'select',
							'name'          => 'item_vertical_anchor',
							'title'         => esc_html__( 'Image Vertical Anchor', 'firstframe-core' ),
							'options'       => array(
								'top'    => esc_html__( 'Top', 'firstframe-core' ),
								'bottom' => esc_html__( 'Bottom', 'firstframe-core' ),
							),
							'default_value' => 'top',
						),
						array(
							'field_type'    => 'text',
							'name'          => 'item_vertical_position',
							'title'         => esc_html__( 'Image Vertical Position', 'firstframe-core' ),
							'default_value' => '25%',
						),
						array(
							'field_type'    => 'select',
							'name'          => 'item_horizontal_anchor',
							'title'         => esc_html__( 'Image Horizontal Anchor', 'firstframe-core' ),
							'options'       => array(
								'left'  => esc_html__( 'Left', 'firstframe-core' ),
								'right' => esc_html__( 'Right', 'firstframe-core' ),
							),
							'default_value' => 'left',
						),
						array(
							'field_type'    => 'text',
							'name'          => 'item_horizontal_position',
							'title'         => esc_html__( 'Image Horizontal Position', 'firstframe-core' ),
							'default_value' => '25%',
						),
					),
				)
			);
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'firstframe_core_stacked_images', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['item_classes']   = $this->get_item_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );

			return firstframe_core_get_template_part( 'shortcodes/stacked-images', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-stacked-images';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes = array();

			$item_classes[] = 'qodef-m-image';
			$item_classes[] = ! empty( $atts['parallax_item'] ) && ( 'yes' === $atts['parallax_item'] ) ? 'qodef-parallax-item' : '';

			return $item_classes;
		}
	}
}
