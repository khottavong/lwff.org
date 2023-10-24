<?php

// row

if ( ! function_exists( 'firstframe_core_vc_row_background_text' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function firstframe_core_vc_row_background_text() {

		/******* VC Row shortcode - begin *******/

		//Background text options

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_enable',
				'heading'    => esc_html__( 'Enable Background Text', 'firstframe-core' ),
				'value'      => array(
					esc_html__( 'Default', 'firstframe-core' ) => '',
					esc_html__( 'Yes', 'firstframe-core' ) => 'yes',
					esc_html__( 'No', 'firstframe-core' )  => 'no',
				),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_text',
				'heading'    => esc_html__( 'Background Text', 'firstframe-core' ),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'background_text_color',
				'heading'    => esc_html__( 'Background Text  Color', 'firstframe-core' ),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_text_size',
				'heading'     => esc_html__( 'Background Text Size', 'firstframe-core' ),
				'description' => esc_html( 'Set the background text size in px or em', 'firstframe-core' ),
				'group'       => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency'  => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'background_text_outline_color',
				'heading'    => esc_html__( 'Text Outline Color', 'firstframe-core' ),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_text_outline_stroke_width',
				'heading'    => esc_html__( 'Text Outline Width', 'firstframe-core' ),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_align',
				'heading'    => esc_html__( 'Background Text Align', 'firstframe-core' ),
				'value'      => array(
					esc_html__( 'Default', 'firstframe-core' ) => '',
					esc_html__( 'Left', 'firstframe-core' )  => 'left',
					esc_html__( 'Center', 'firstframe-core' ) => 'center',
					esc_html__( 'Right', 'firstframe-core' ) => 'right',
				),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_vertical_align',
				'heading'    => esc_html__( 'Background Text Vertical Align', 'firstframe-core' ),
				'value'      => array(
					esc_html__( 'Default', 'firstframe-core' ) => '',
					esc_html__( 'Top', 'firstframe-core' ) => 'flex-start',
					esc_html__( 'Middle', 'firstframe-core' ) => 'center',
					esc_html__( 'Bottom', 'firstframe-core' ) => 'flex-end',
				),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		/******* VC Row shortcode - end *******/

	}

	add_action( 'firstframe_core_action_additional_vc_row_params', 'firstframe_core_vc_row_background_text' );
}

// row inner

if ( ! function_exists( 'firstframe_core_vc_row_inner_background_text' ) ) {
	/**
	 * Map VC Row inner shortcode
	 * Hooks on vc_after_init action
	 */
	function firstframe_core_vc_row_inner_background_text() {

		/******* VC Row Inner shortcode - begin *******/

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_enable',
				'heading'    => esc_html__( 'Enable Background Text', 'firstframe-core' ),
				'value'      => array(
					esc_html__( 'Default', 'firstframe-core' ) => '',
					esc_html__( 'Yes', 'firstframe-core' ) => 'yes',
					esc_html__( 'No', 'firstframe-core' )  => 'no',
				),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_text',
				'heading'    => esc_html__( 'Background Text', 'firstframe-core' ),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'background_text_color',
				'heading'    => esc_html__( 'Background Text  Color', 'firstframe-core' ),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_text_size',
				'heading'    => esc_html__( 'Background Text Size', 'firstframe-core' ),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'background_text_outline_color',
				'heading'    => esc_html__( 'Text Outline Color', 'firstframe-core' ),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_text_outline_stroke_width',
				'heading'     => esc_html__( 'Text Outline Width', 'firstframe-core' ),
				'description' => esc_html( 'Set the background text size in px or em', 'firstframe-core' ),
				'group'       => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency'  => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_align',
				'heading'    => esc_html__( 'Background Text Align', 'firstframe-core' ),
				'value'      => array(
					esc_html__( 'Default', 'firstframe-core' ) => '',
					esc_html__( 'Left', 'firstframe-core' )  => 'flex-start',
					esc_html__( 'Center', 'firstframe-core' ) => 'center',
					esc_html__( 'Right', 'firstframe-core' ) => 'flex-end',
				),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		vc_add_param(
			'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_text_vertical_align',
				'heading'    => esc_html__( 'Background Text Vertical Align', 'firstframe-core' ),
				'value'      => array(
					esc_html__( 'Default', 'firstframe-core' ) => '',
					esc_html__( 'Top', 'firstframe-core' ) => 'flex-start',
					esc_html__( 'Middle', 'firstframe-core' ) => 'center',
					esc_html__( 'Bottom', 'firstframe-core' ) => 'flex-end',
				),
				'group'      => esc_html__( 'FirstFrame Core Settings', 'firstframe-core' ),
				'dependency' => array(
					'element' => 'background_text_enable',
					'value'   => array( 'yes' ),
				),
			)
		);

		/******* VC Row Inner shortcode - end *******/

	}

	add_action( 'firstframe_core_action_additional_vc_row_inner_params', 'firstframe_core_vc_row_inner_background_text' );
}

if ( ! function_exists( 'firstframe_core_add_background_text' ) ) {
	function firstframe_core_add_background_text( $html, $atts ) {

		$params = array();

		//text
		$params['text'] = $atts['background_text'];

		//content style
		$background_text_content_style = array();
		if ( '' !== $atts['background_text_align'] ) {
			$background_text_content_style[] = 'justify-content:' . $atts['background_text_align'];
		}

		if ( '' !== $atts['background_text_vertical_align'] ) {
			$background_text_content_style[] = 'align-items:' . $atts['background_text_vertical_align'];
		}
		$params['background_text_content_style'] = implode( '; ', $background_text_content_style );

		//text style
		$background_text_style = array();
		if ( '' !== $atts['background_text_color'] ) {
			$background_text_style [] = 'color:' . $atts['background_text_color'];
		}

		if ( '' !== $atts['background_text_size'] ) {
			$background_text_style [] = 'font-size:' . intval( $atts['background_text_size'] ) . 'px';
		}

		if ( '' !== $atts['background_text_outline_stroke_width'] ) {
			$background_text_style [] = '-webkit-text-stroke-width:' . intval( $atts['background_text_outline_stroke_width'] ) . 'px';
		}

		if ( '' !== $atts['background_text_outline_color'] ) {
			$background_text_style [] = '-webkit-text-stroke-color:' . $atts['background_text_outline_color'];
		}

		$params['background_text_style'] = implode( '; ', $background_text_style );

		if ( '' !== $atts['background_text'] ) {
			$html .= firstframe_core_get_template_part( 'background-text', 'templates/background-text', '', $params );
		}

		return $html;
	}

	add_filter( 'firstframe_core_filter_vc_row_after_wrapper_open', 'firstframe_core_add_background_text', 10, 2 );
	add_filter( 'firstframe_core_filter_vc_row_inner_after_wrapper_open', 'firstframe_core_add_background_text', 10, 2 );
}

if ( ! function_exists( 'firstframe_core_add_additional_classes_on_row_text' ) ) {
	function firstframe_core_add_additional_classes_on_row_text( $classes, $base, $atts ) {

		if ( 'vc_row' === $base || 'vc_row_inner' === $base ) {
			if ( 'yes' === $atts['background_text_enable'] ) {
				$classes .= ' qodef-background-text';
			}

			if ( '' !== $atts['background_text_align'] ) {
				$classes .= ' qodef-background-text-alignment--' . $atts['background_text_align'];
			}
		}

		return $classes;
	}

	add_filter( 'vc_shortcodes_css_class', 'firstframe_core_add_additional_classes_on_row_text', 10, 3 );
}
