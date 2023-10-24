<?php

if ( ! function_exists( 'firstframe_core_add_countdown_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function firstframe_core_add_countdown_shortcode( $shortcodes ) {
		$shortcodes[] = 'FirstFrameCore_Countdown_Shortcode';

		return $shortcodes;
	}

	add_filter( 'firstframe_core_filter_register_shortcodes', 'firstframe_core_add_countdown_shortcode' );
}

if ( class_exists( 'FirstFrameCore_Shortcode' ) ) {
	class FirstFrameCore_Countdown_Shortcode extends FirstFrameCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'firstframe_core_filter_countdown_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( FIRSTFRAME_CORE_SHORTCODES_URL_PATH . '/countdown' );
			$this->set_base( 'firstframe_core_countdown' );
			$this->set_name( esc_html__( 'Countdown', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays countdown with provided parameters', 'firstframe-core' ) );

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
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'date',
					'name'        => 'date',
					'title'       => esc_html__( 'Date', 'firstframe-core' ),
					'description' => esc_html__( 'Enter date in format Y/m/d H:i:s', 'firstframe-core' ),
					//because of the wpbackery
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'week_label',
					'title'      => esc_html__( 'Week Label', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'week_label_plural',
					'title'      => esc_html__( 'Week Label Plural', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'day_label',
					'title'      => esc_html__( 'Day Label', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'day_label_plural',
					'title'      => esc_html__( 'Day Label Plural', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'hour_label',
					'title'      => esc_html__( 'Hour Label', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'hour_label_plural',
					'title'      => esc_html__( 'Hour Label Plural', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'minute_label',
					'title'      => esc_html__( 'Minute Label', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'minute_label_plural',
					'title'      => esc_html__( 'Minute Label Plural', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'second_label',
					'title'      => esc_html__( 'Second Label', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'second_label_plural',
					'title'      => esc_html__( 'Second Label Plural', 'firstframe-core' ),
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
					'field_type'    => 'select',
					'name'          => 'enable_border',
					'title'         => esc_html__( 'Enable Item border', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'no_yes' ),
					'default_value' => 'no',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'font_size',
					'title'      => esc_html__( 'Digit Font Size', 'firstframe-core' ),
					'group'      => esc_html__( 'Style', 'firstframe-core' ),
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['data_attrs']     = $this->get_data_attrs( $atts );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['digit_styles']   = $this->get_digit_styles( $atts );

			return firstframe_core_get_template_part( 'shortcodes/countdown', 'variations/' . $atts['layout'] . '/templates/countdown', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-countdown';
			$holder_classes[] = 'qodef-show--5';

			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-countdown--' . $atts['skin'] : '';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['enable_border'] ) && 'yes' === $atts['enable_border'] ? 'qodef-enable-border--yes' : 'qodef-enable-border--no';

			return implode( ' ', $holder_classes );
		}

		private function get_digit_styles( $atts ) {
			$styles = array();

			$font_size = $atts['font_size'];
			if ( ! empty( $font_size ) ) {
				if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
					$styles[] = 'font-size: ' . $font_size;
				} else {
					$styles[] = 'font-size: ' . intval( $font_size ) . 'px';
				}
			}

			return $styles;
		}

		private function get_data_attrs( $atts ) {
			$data = array();

			if ( ! empty( $atts['date'] ) ) {
				$date              = $atts['date'];
				$date_formatted    = gmdate( 'Y/m/d H:i:s', strtotime( $date ) );
				$data['data-date'] = $date_formatted;
			}

			$date_formats = array(
				'week'   => array(
					'default' => esc_html__( 'Week', 'firstframe-core' ),
					'plural'  => esc_html__( 'Weeks', 'firstframe-core' ),
				),
				'day'    => array(
					'default' => esc_html__( 'Day', 'firstframe-core' ),
					'plural'  => esc_html__( 'Days', 'firstframe-core' ),
				),
				'hour'   => array(
					'default' => esc_html__( 'Hour', 'firstframe-core' ),
					'plural'  => esc_html__( 'Hours', 'firstframe-core' ),
				),
				'minute' => array(
					'default' => esc_html__( 'Minute', 'firstframe-core' ),
					'plural'  => esc_html__( 'Minutes', 'firstframe-core' ),
				),
				'second' => array(
					'default' => esc_html__( 'Second', 'firstframe-core' ),
					'plural'  => esc_html__( 'Seconds', 'firstframe-core' ),
				),
			);

			foreach ( $date_formats as $key => $value ) {
				if ( ! empty( $atts[ $key . '_label' ] ) ) {
					$data[ 'data-' . $key . '-label' ] = $atts[ $key . '_label' ];
				} else {
					$data[ 'data-' . $key . '-label' ] = $value['default'];
				}

				if ( ! empty( $atts[ $key . '_label_plural' ] ) ) {
					$data[ 'data-' . $key . '-label-plural' ] = $atts[ $key . '_label_plural' ];
				} else {
					$data[ 'data-' . $key . '-label-plural' ] = $value['plural'];
				}
			}

			return $data;
		}
	}
}
