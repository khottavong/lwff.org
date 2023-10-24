<?php

if ( ! function_exists( 'firstframe_core_add_image_gallery_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function firstframe_core_add_image_gallery_shortcode( $shortcodes ) {
		$shortcodes[] = 'FirstFrameCore_Image_Gallery_Shortcode';

		return $shortcodes;
	}

	add_filter( 'firstframe_core_filter_register_shortcodes', 'firstframe_core_add_image_gallery_shortcode' );
}

if ( class_exists( 'FirstFrameCore_List_Shortcode' ) ) {
	class FirstFrameCore_Image_Gallery_Shortcode extends FirstFrameCore_List_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( FIRSTFRAME_CORE_SHORTCODES_URL_PATH . '/image-gallery' );
			$this->set_base( 'firstframe_core_image_gallery' );
			$this->set_name( esc_html__( 'Image Gallery', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image gallery element', 'firstframe-core' ) );
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
					'field_type' => 'image',
					'name'       => 'images',
					'multiple'   => 'yes',
					'title'      => esc_html__( 'Images', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'image_size',
					'title'       => esc_html__( 'Image Size', 'firstframe-core' ),
					'description' => esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'firstframe-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'image_action',
					'title'      => esc_html__( 'Image Action', 'firstframe-core' ),
					'options'    => array(
						''                 => esc_html__( 'No Action', 'firstframe-core' ),
						'open-popup'       => esc_html__( 'Open Popup', 'firstframe-core' ),
						'open-video-popup' => esc_html__( 'Open Video Popup', 'firstframe-core' ),
						'custom-link'      => esc_html__( 'Custom Link', 'firstframe-core' ),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'target',
					'title'         => esc_html__( 'Custom Link Target', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
					'dependency'    => array(
						'show' => array(
							'image_action' => array(
								'values'        => 'custom-link',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'skew_slider',
					'title'         => esc_html__( 'Skew Slider', 'firstframe-core' ),
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
			$this->map_list_options(
				array(
					'exclude_behavior'      => array( 'justified-gallery' ),
					'exclude_option'        => array( 'images_proportion' ),
					'group'                 => esc_html__( 'Gallery Settings', 'firstframe-core' ),
					'include_slider_option' => array(
						'slider_direction',
						'slider_hidden_slides',
						'slider_mousewheel_navigation',
						'slider_centered_slides',
						'slider_drag_cursor',
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'scaled_centered_slide',
					'title'         => esc_html__( 'Scaled Centered Slide', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'no_yes' ),
					'default_value' => '',
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
					'name'          => 'border_between',
					'title'         => esc_html__( 'Borders Between', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'description'   => esc_html__( 'Works only with Gallery List Appearance', 'firstframe-core' ),
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => array( 'columns' ),
								'default_value' => 'columns',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'hover_type',
					'title'         => esc_html__( 'Hover Type', 'firstframe-core' ),
					'options'       => array(
						'overlay' => esc_html__( 'Overlay', 'firstframe-core' ),
						'zoom'    => esc_html__( 'Zoom', 'firstframe-core' ),
						''        => esc_html__( 'None', 'firstframe-core' ),
					),
					'default_value' => 'overlay',
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'firstframe_core_image_gallery', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {

			if ( isset( $atts['image_action'] ) && ( 'open-popup' === $atts['image_action'] || 'open-video-popup' === $atts['image_action'] ) ) {
				wp_enqueue_style( 'magnific-popup' );
				wp_enqueue_script( 'jquery-magnific-popup' );
			}
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			// regular slider override start
			if ( isset( $atts['slider_width'] ) && $atts['slider_width'] === 'yes' && $atts['skew_slider'] !== 'yes' ) {
				$atts['slider_looped_slides'] = '10';
			}

//			if ( isset( $atts['scaled_centered_slide'] ) && $atts['scaled_centered_slide'] === 'yes' ) {
//				$atts['columns'] = 'auto';
//			}
			// regular slider override end
			$atts['unique']               = rand( 0, 1000 );
			$atts['holder_classes']       = $this->get_holder_classes( $atts );
			$atts['outer_holder_classes'] = $this->get_outer_holder_classes( $atts );
			$atts['item_classes']         = $this->get_item_classes( $atts );
			$atts['slider_attr']          = $this->get_slider_data( $atts );
			$atts['images']               = $this->generate_images_params( $atts );

			return firstframe_core_get_template_part( 'shortcodes/image-gallery', 'templates/image-gallery', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-image-gallery qodef-grid';
			$holder_classes[] = ! empty( $atts['image_action'] ) && ( 'open-popup' === $atts['image_action'] || 'open-video-popup' === $atts['image_action'] ) ? 'qodef-magnific-popup qodef-popup-gallery' : '';
			$holder_classes[] = 'yes' === $atts['border_between'] ? 'qodef--borders-between' : '';
			$holder_classes[] = ! empty( $atts['hover_type'] ) ? 'qodef--hover-' . $atts['hover_type'] : '';


			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		private function get_outer_holder_classes( $atts ) {
			$holder_classes = array();

			$holder_classes[] = 'qodef-image-slider-holder';

			if ( isset( $atts['scaled_centered_slide'] ) && $atts['scaled_centered_slide'] === 'yes' ) {
				$holder_classes[] = 'qodef-scaled-centered-slide';
			}

			if ( isset( $atts['skew_slider'] ) && $atts['skew_slider'] === 'yes' ) {
				$holder_classes[] = 'qodef-skew-slider-holder';
			}

			if ( isset( $atts['enable_background_text'] ) && $atts['enable_background_text'] === 'yes' ) {
				$holder_classes[] = 'qodef-background-text';
			}

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes   = $this->init_item_classes();
			$item_classes[] = 'qodef-image-wrapper';

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		private function generate_images_params( $atts ) {
			$image_ids = array();
			$images    = array();
			$i         = 0;

			if ( ! empty( $atts['images'] ) ) {
				$image_ids = explode( ',', $atts['images'] );
			}

			$image_size = $this->generate_image_size( $atts );

			foreach ( $image_ids as $id ) {
				if ( is_array( wp_get_attachment_image_src( $id ) ) ) {
					$image['image_id']   = intval( $id );
					$image_original      = wp_get_attachment_image_src( $id, 'full' );
					$image['url']        = $this->generate_image_url( $id, $atts, $image_original[0] );
					$image['data_type']  = $this->generate_image_data_type( $id, $atts );
					$image['alt']        = get_post_meta( $id, '_wp_attachment_image_alt', true );
					$image['image_size'] = $image_size;

					$images[ $i ] = $image;
					$i ++;
				}
			}

			return $images;
		}

		private function generate_image_size( $atts ) {
			$image_size = trim( $atts['image_size'] );
			preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
			if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ), true ) ) {
				return $image_size;
			} elseif ( ! empty( $matches[0] ) ) {
				return array(
					$matches[0][0],
					$matches[0][1],
				);
			} else {
				return 'full';
			}
		}

		private function generate_image_url( $id, $atts, $default ) {
			if ( 'custom-link' === $atts['image_action'] ) {
				$url = get_post_meta( $id, 'qodef_image_gallery_custom_link', true );
				if ( empty( $url ) ) {
					$url = $default;
				}
			} else if ( 'open-video-popup' === $atts['image_action'] ) {
				$url = get_post_meta( $id, 'qodef_image_gallery_custom_link', true );
				if ( empty( $url ) ) {
					$url = $default;
				}
			} else {
				$url = $default;
			}

			return $url;
		}

		private function generate_image_data_type( $id, $atts ) {
			if ( 'open-popup' === $atts['image_action'] ) {
				$data_type = 'image';
			}
			if ( 'open-video-popup' === $atts['image_action'] ) {
				$url = get_post_meta( $id, 'qodef_image_gallery_custom_link', true );
				if ( empty( $url ) ) {
					$data_type = 'image';
				} else {
					$data_type = 'iframe';
				}
			} else {
				$data_type = '';
			}

			return $data_type;
		}
	}
}
