<?php

if ( ! function_exists( 'firstframe_core_add_portfolio_project_info_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function firstframe_core_add_portfolio_project_info_shortcode( $shortcodes ) {
		$shortcodes[] = 'FirstFrameCore_Portfolio_Project_Info_Shortcode';

		return $shortcodes;
	}

	add_filter( 'firstframe_core_filter_register_shortcodes', 'firstframe_core_add_portfolio_project_info_shortcode' );
}

if ( class_exists( 'FirstFrameCore_Shortcode' ) ) {
	class FirstFrameCore_Portfolio_Project_Info_Shortcode extends FirstFrameCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'firstframe_core_filter_portfolio_project_info_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( FIRSTFRAME_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-project-info' );
			$this->set_base( 'firstframe_core_portfolio_project_info' );
			$this->set_name( esc_html__( 'Portfolio Project Info', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Shortcode that display list of category items', 'firstframe-core' ) );
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
					'name'       => 'custom_text_option',
					'title'      => esc_html__( 'Custom Text Option', 'firstframe-core' ),
					'options'    => firstframe_core_get_select_type_options_pool( 'no_yes', false ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_text',
					'title'      => esc_html__( 'Custom Text', 'firstframe-core' ),
					'dependency' => array(
						'show' => array(
							'custom_text_option' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'portfolio_id',
					'title'      => esc_html__( 'Portfolio Item', 'firstframe-core' ),
					'options'    => qode_framework_get_cpt_items( 'portfolio-item', '', true ),
					'dependency' => array(
						'show' => array(
							'custom_text_option' => array(
								'values'        => 'no',
								'default_value' => 'no'
							)
						)
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'project_info_type',
					'title'      => esc_html__( 'Project Info Type', 'firstframe-core' ),
					'options'    => array(
						'title'      => esc_html__( 'Title', 'firstframe-core' ),
						'categories' => esc_html__( 'Category', 'firstframe-core' ),
						'tags'       => esc_html__( 'Tag', 'firstframe-core' ),
						'author'     => esc_html__( 'Author', 'firstframe-core' ),
						'date'       => esc_html__( 'Date', 'firstframe-core' ),
						'image'      => esc_html__( 'Featured Image', 'firstframe-core' ),
					),
					'dependency' => array(
						'show' => array(
							'custom_text_option' => array(
								'values'        => 'no',
								'default_value' => 'no'
							)
						)
					),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'project_info_label',
					'title'       => esc_html__( 'Project Info Label', 'firstframe-core' ),
					'description' => esc_html__( 'Add project info label before project info element/s', 'firstframe-core' ),
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['project_id']     = ! empty( $atts['portfolio_id'] ) ? $atts['portfolio_id'] : get_the_ID();
			$atts['this_shortcode'] = $this;

			return firstframe_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-project-info', 'templates/content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-project-info';

			return implode( ' ', $holder_classes );
		}
	}
}
