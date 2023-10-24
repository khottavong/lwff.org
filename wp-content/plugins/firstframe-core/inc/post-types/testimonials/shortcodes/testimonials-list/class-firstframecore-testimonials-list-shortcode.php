<?php

if ( ! function_exists( 'firstframe_core_add_testimonials_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function firstframe_core_add_testimonials_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'FirstFrameCore_Testimonials_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'firstframe_core_filter_register_shortcodes', 'firstframe_core_add_testimonials_list_shortcode' );
}

if ( class_exists( 'FirstFrameCore_List_Shortcode' ) ) {
	class FirstFrameCore_Testimonials_List_Shortcode extends FirstFrameCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'testimonials' );
			$this->set_post_type_additional_taxonomies( array( 'testimonials-category' ) );
			$this->set_layouts( apply_filters( 'firstframe_core_filter_testimonials_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'firstframe_core_filter_testimonials_list_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( FIRSTFRAME_CORE_CPT_URL_PATH . '/testimonials/shortcodes/testimonials-list' );
			$this->set_base( 'firstframe_core_testimonials_list' );
			$this->set_name( esc_html__( 'Testimonials List', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of testimonials', 'firstframe-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'firstframe-core' ),
				)
			);
			$this->map_list_options(
				array(
					'exclude_behavior'      => array( 'masonry', 'justified-gallery' ),
					'exclude_option'        => array( 'images_proportion' ),
					'include_slider_option' => array(
						'slider_direction',
						'slider_centered_slides',
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'skin',
					'title'      => esc_html__( 'Skin', 'firstframe-core' ),
					'options'    => firstframe_core_get_select_type_options_pool( 'shortcode_skin' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'static_title',
					'title'      => esc_html__( 'Static Title', 'firstframe-core' ),
					'group'      => esc_html__( 'Layout', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'static_title_tag',
					'title'         => esc_html__( 'Static Title Tag', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'title_tag', false ),
					'default_value' => 'h2',
					'group'         => esc_html__( 'Layout', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'enable_background_text',
					'title'         => esc_html__( 'Enable Background Text', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'no_yes', false ),
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values' => 'slider',
							),
						),
					),
					'default_value' => ''
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'background_text',
					'title'         => esc_html__( 'Background Text', 'firstframe-core' ),
					'dependency'    => array(
						'show' => array(
							'enable_background_text' => array(
								'values' => 'yes',
							),
						),
					),
					'default_value' => ''
				)
			);
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options( array( 'layouts' => $this->get_layouts() ) );
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'firstframe_core_testimonials_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type'] = $this->get_post_type();

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['unique']               = rand( 0, 1000 );
			$atts['outer_holder_classes'] = $this->get_outer_holder_classes( $atts );
			$atts['holder_classes']       = $this->get_holder_classes( $atts );
			$atts['item_classes']         = $this->get_item_classes( $atts );
			$atts['slider_thumb_attr']    = $this->get_thumb_slider_data( $atts );
			$atts['unique']               = wp_unique_id();

			$atts['slider_attr'] = $this->get_slider_data( $atts, array(
				'unique'            => $atts['unique'],
				'outsideNavigation' => 'yes',


			) );

			if ( $atts['layout'] === 'images-on-the-side' && $atts['behavior'] === 'slider' ) {
				$atts['slider_attr'] = $this->get_slider_data( $atts, array(
					'unique'            => $atts['unique'],
					'outsideNavigation' => 'yes',


				) );
			}

			$atts['query_result'] = new WP_Query( firstframe_core_get_query_params( $atts ) );

			$atts['this_shortcode'] = $this;

			if ( $atts['layout'] === 'images-on-the-side' && $atts['behavior'] === 'slider' ) {
				return firstframe_core_get_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/content', $atts['behavior'] . '-' . 'images-on-the-side', $atts );
			} elseif ( $atts['layout'] === 'images-thumb' && $atts['behavior'] === 'slider' ) {
				return firstframe_core_get_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/content', $atts['behavior'] . '-' . 'thumb', $atts );
			} else {
				return firstframe_core_get_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/content', $atts['behavior'], $atts );
			}
		}

		private function get_outer_holder_classes( $atts ) {
			$holder_classes   = array();
			$holder_classes[] = isset( $atts['skin'] ) && ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			$holder_classes[] = 'qodef-testimonials-slider-holder';


			if ( isset( $atts['enable_background_text'] ) && $atts['enable_background_text'] === 'yes' ) {
				$holder_classes[] = 'qodef-background-text';
			}

			return implode( ' ', $holder_classes );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes   = $this->init_holder_classes();
			$holder_classes[] = 'qodef-testimonials-list';
			$holder_classes[] = isset( $atts['skin'] ) && ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			$list_classes     = $this->get_list_classes( $atts );
			if ( $atts['layout'] === 'images-on-the-side' && $atts['behavior'] === 'slider' ) {
				if ( ( $key = array_search( 'qodef-swiper-container', $list_classes ) ) !== false ) {
					unset( $list_classes[ $key ] );
				}
			}

			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		private function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			return $styles;
		}

		public function get_thumb_slider_data( $atts ) {
			$data = array();

			$data['loop']             = isset( $atts['slider_loop'] ) ? 'no' !== $atts['slider_loop'] : true;
			$data['autoplay']         = isset( $atts['slider_autoplay'] ) ? 'no' !== $atts['slider_autoplay'] : true;
			$data['slidesPerView']    = '3';
			$data['slidesPerView768'] = '3';
			$data['slidesPerView680'] = '3';
			$data['slidesPerView480'] = '3';

			return json_encode( $data );
		}
	}
}
