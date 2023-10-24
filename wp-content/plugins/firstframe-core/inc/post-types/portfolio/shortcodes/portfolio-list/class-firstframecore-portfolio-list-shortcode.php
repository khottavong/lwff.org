<?php

if ( ! function_exists( 'firstframe_core_add_portfolio_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function firstframe_core_add_portfolio_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'FirstFrameCore_Portfolio_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'firstframe_core_filter_register_shortcodes', 'firstframe_core_add_portfolio_list_shortcode' );
}

if ( class_exists( 'FirstFrameCore_List_Shortcode' ) ) {
	class FirstFrameCore_Portfolio_List_Shortcode extends FirstFrameCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( array( 'portfolio-tag' ) );
			$this->set_layouts( apply_filters( 'firstframe_core_filter_portfolio_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'firstframe_core_filter_portfolio_list_extra_options', array() ) );
			$this->set_hover_animation_options( apply_filters( 'firstframe_core_filter_portfolio_list_hover_animation_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( FIRSTFRAME_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-list' );
			$this->set_base( 'firstframe_core_portfolio_list' );
			$this->set_name( esc_html__( 'Portfolio List', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of portfolios', 'firstframe-core' ) );
			$this->set_scripts( apply_filters( 'firstframe_core_filter_portfolio_list_register_assets', array() ) );
			$this->set_scripts(
				array(
					'jquery-magnific-popup' => array(
						'registered' => true,
					),
				)
			);
			$this->set_necessary_styles(
				array(
					'magnific-popup' => array(
						'registered' => true,
					),
				)
			);
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
					'name'          => 'enable_image_highlight',
					'title'         => esc_html__( 'Enable Image Highlight', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'yes_no', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => array( 'slider' ),
								'default_value' => 'columns',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'full_screen_slider',
					'title'         => esc_html__( 'Full Screen Slider', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => array( 'slider' ),
								'default_value' => 'columns',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'fullscreen_widget_area',
					'title'      => esc_html__( 'Fullscreen Slider Widget Area', 'firstframe-core' ),
					'dependency' => array(
						'show' => array(
							'full_screen_slider' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
					'options'    => array_merge(
						array(
							'' => ''
						),
						firstframe_core_get_custom_sidebars()
					),
					'group'      => esc_html__( 'Fullscreen Slider Widget Area', 'firstframe-core' ),
				)
			);
			$this->map_list_options(
				array(
					'include_slider_option' => array(
						'slider_centered_slides',
						'slider_mousewheel_navigation',
					),
				)
			);
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options(
				array(
					'layouts'          => $this->get_layouts(),
					'hover_animations' => $this->get_hover_animation_options(),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'custom_margin',
					'title'         => esc_html__( 'Use Item Custom Margin', 'firstframe-core' ),
					'description'   => esc_html__( 'If you set this option to “Yes”, the margin values defined in the Portfolio Item Custom Margin field will be applied', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => array( 'columns', 'masonry' ),
								'default_value' => 'columns',
							),
						),
					),
					'group'         => esc_html__( 'Layout', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'play_button',
					'title'         => esc_html__( 'Enable Play Button', 'firstframe-core' ),
					'description'   => esc_html__( 'If you set this option to “Yes”, Play Button will show up on top of image', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Layout', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'hide_info',
					'title'         => esc_html__( 'Hide Info', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'layout' => array(
								'values' => array( 'info-on-hover', 'info-on-image', 'info-below' ),
							),
						),
					),
					'group'         => esc_html__( 'Layout', 'firstframe-core' ),
				)
			);
			$this->import_shortcode_options(
				array(
					'shortcode_base'    => 'firstframe_core_text_marquee',
					'exclude'           => array( 'custom_class' ),
					'additional_params' => array(
						'nested_group' => esc_html__( 'Title marquee', 'firstframe-core' ),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'hidden',
					'name'          => 'is_related',
					'title'         => esc_html__( 'Is related', 'firstframe-core' ),
					'default_value' => 'false',
					'group'         => esc_html__( 'Layout', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'border_between',
					'title'         => esc_html__( 'Borders Between', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'description'   => esc_html__( 'Works only with Gallery List Appearance', 'firstframe-core' ),
					'dependency'    => array(
						'show' => array(
							'layout' => array(
								'values'        => array( 'info-on-image', 'info-on-hover' ),
								'default_value' => 'info-below',
							),
						),
					),
				)
			);
			$this->map_additional_options();
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'firstframe_core_portfolio_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {
			parent::load_assets();

			do_action( 'firstframe_core_action_portfolio_list_load_assets', $this->get_atts() );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_filter_taxonomy( $atts );

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['query_result']   = new WP_Query( firstframe_core_get_query_params( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts, 'yes' === $atts['full_screen_slider'] ? array( 'sliderScroll' => true ) : array() );
			$atts['data_attr']      = firstframe_core_get_pagination_data( FIRSTFRAME_CORE_REL_PATH, 'post-types/portfolio/shortcodes', 'portfolio-list', 'portfolio', $atts );

			$atts['this_shortcode'] = $this;

			return firstframe_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[]        = 'qodef-portfolio-list';
			$holder_classes[]        = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			$holder_classes[]        = 'yes' === $atts['enable_image_highlight'] ? 'qodef--image-highlight-enabled' : '';
			$holder_classes[]        = 'yes' === $atts['hide_info'] ? 'qodef-item--hide-info' : '';
			$holder_classes[]        = 'yes' === $atts['full_screen_slider'] ? 'qodef--full-screen-slider' : '';
			$holder_classes[]        = 'yes' === $atts['border_between'] ? 'qodef--borders-between' : '';
			$list_classes            = $this->get_list_classes( $atts );
			$hover_animation_classes = $this->get_hover_animation_classes( $atts );
			$holder_classes          = array_merge( $holder_classes, $list_classes, $hover_animation_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			$list_item_classes = $this->get_list_item_classes( $atts );

			if ( isset( $atts['custom_margin'] ) && 'yes' === $atts['custom_margin'] ) {
				$list_item_classes[] = 'qodef-custom-margin';
			}

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

		public function get_list_item_style( $atts ) {
			$styles = array();

			if ( isset( $atts['custom_margin'] ) && 'yes' === $atts['custom_margin'] ) {
				$margin = get_post_meta( get_the_ID(), 'qodef_portfolio_item_padding', true );

				if ( isset( $margin ) && '' !== $margin ) {
					$styles[] = 'margin: ' . get_post_meta( get_the_ID(), 'qodef_portfolio_item_padding', true );
				}
			}

			return $styles;
		}


	}
}
