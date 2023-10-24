<?php

if ( ! function_exists( 'firstframe_core_add_separator_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function firstframe_core_add_separator_shortcode( $shortcodes ) {
		$shortcodes[] = 'FirstFrameCore_Separator_Shortcode';

		return $shortcodes;
	}

	add_filter( 'firstframe_core_filter_register_shortcodes', 'firstframe_core_add_separator_shortcode', 9 );
}

if ( class_exists( 'FirstFrameCore_Shortcode' ) ) {
	class FirstFrameCore_Separator_Shortcode extends FirstFrameCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( FIRSTFRAME_CORE_SHORTCODES_URL_PATH . '/separator' );
			$this->set_base( 'firstframe_core_separator' );
			$this->set_name( esc_html__( 'Separator', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays separator with provided parameters', 'firstframe-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'position',
					'title'      => esc_html__( 'Position', 'firstframe-core' ),
					'options'    => array(
						''       => esc_html__( 'Default', 'firstframe-core' ),
						'center' => esc_html__( 'Center', 'firstframe-core' ),
						'left'   => esc_html__( 'Left', 'firstframe-core' ),
						'right'  => esc_html__( 'Right', 'firstframe-core' ),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'disable_below',
					'title'      => esc_html__( 'Disable Below', 'firstframe-core' ),
					'options'    => array(
						''     => esc_html__( 'Default', 'firstframe-core' ),
						'1024' => esc_html__( 'Screen Size 1024', 'firstframe-core' ),
						'768'  => esc_html__( 'Screen Size 768', 'firstframe-core' ),
						'680'  => esc_html__( 'Screen Size 680', 'firstframe-core' ),
						'480'  => esc_html__( 'Screen Size 480', 'firstframe-core' ),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'color',
					'title'      => esc_html__( 'Color', 'firstframe-core' ),
					'group'      => esc_html__( 'Style', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'border_style',
					'title'      => esc_html__( 'Border Style', 'firstframe-core' ),
					'options'    => firstframe_core_get_select_type_options_pool( 'border_style' ),
					'group'      => esc_html__( 'Style', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'width',
					'title'      => esc_html__( 'Width (px or %)', 'firstframe-core' ),
					'group'      => esc_html__( 'Style', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'thickness',
					'title'      => esc_html__( 'Thickness (px)', 'firstframe-core' ),
					'group'      => esc_html__( 'Style', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'margin_top',
					'title'      => esc_html__( 'Margin Top (px or %)', 'firstframe-core' ),
					'group'      => esc_html__( 'Style', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'margin_bottom',
					'title'      => esc_html__( 'Margin Bottom (px or %)', 'firstframe-core' ),
					'group'      => esc_html__( 'Style', 'firstframe-core' ),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'firstframe_core_separator', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']   = $this->get_holder_classes( $atts );
			$atts['separator_styles'] = $this->get_separator_styles( $atts );

			return firstframe_core_get_template_part( 'shortcodes/separator', 'templates/separator', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-separator';
			$holder_classes[] = 'clear';
			$holder_classes[] = ! empty( $atts['position'] ) ? 'qodef-position--' . $atts['position'] : '';
			$holder_classes[] = ! empty( $atts['disable_below'] ) ? 'qodef-disabled--' . $atts['disable_below'] : '';

			return implode( ' ', $holder_classes );
		}

		private function get_separator_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['color'] ) ) {
				$styles[] = 'border-color: ' . $atts['color'];
			}

			if ( ! empty( $atts['border_style'] ) ) {
				$styles[] = 'border-style: ' . $atts['border_style'];
			}

			$width = $atts['width'];
			if ( ! empty( $width ) ) {
				if ( qode_framework_string_ends_with_space_units( $width ) ) {
					$styles[] = 'width: ' . $width;
				} else {
					$styles[] = 'width: ' . intval( $width ) . 'px';
				}
			}

			$thickness = $atts['thickness'];
			if ( ! empty( $thickness ) ) {
				$styles[] = 'border-bottom-width: ' . intval( $thickness ) . 'px';
			}

			$margin_top = $atts['margin_top'];
			if ( ! empty( $margin_top ) ) {
				if ( qode_framework_string_ends_with_space_units( $margin_top ) ) {
					$styles[] = 'margin-top: ' . $margin_top;
				} else {
					$styles[] = 'margin-top: ' . intval( $margin_top ) . 'px';
				}
			}

			$margin_bottom = $atts['margin_bottom'];
			if ( ! empty( $margin_bottom ) ) {
				if ( qode_framework_string_ends_with_space_units( $margin_bottom ) ) {
					$styles[] = 'margin-bottom: ' . $margin_bottom;
				} else {
					$styles[] = 'margin-bottom: ' . intval( $margin_bottom ) . 'px';
				}
			}

			return implode( ';', $styles );
		}
	}
}
