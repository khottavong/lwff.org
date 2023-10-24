<?php

if ( ! function_exists( 'firstframe_core_add_title_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function firstframe_core_add_title_widget( $widgets ) {
		$widgets[] = 'FirstFrameCore_Title_Widget';

		return $widgets;
	}

	add_filter( 'firstframe_core_filter_register_widgets', 'firstframe_core_add_title_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FirstFrameCore_Title_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'firstframe_core_title_widget' );
			$this->set_name( esc_html__( 'FirstFrame Title', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Add title element into widget areas', 'firstframe-core' ) );
			$this->set_widget_option(
				array(
					'field_type'    => 'text',
					'name'          => 'title',
					'title'         => esc_html__( 'Title', 'firstframe-core' ),
					'default_value' => esc_html__( 'Title', 'firstframe-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'title_tag',
					'title'      => esc_html__( 'Title Tag', 'firstframe-core' ),
					'options'    => firstframe_core_get_select_type_options_pool( 'title_tag' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'margin_bottom',
					'title'      => esc_html__( 'Bottom Margin', 'firstframe-core' ),
				)
			);
		}

		public function render( $atts ) {
			$title        = $atts['title'];
			$title_tag    = ! empty( $atts['title_tag'] ) ? $atts['title_tag'] : 'h5';
			$title_styles = $this->get_title_styles( $atts );
			?>
			<?php if ( ! empty( $title ) ) : ?>
				<?php echo '<' . esc_attr( $title_tag ); ?> class="qodef-widget-title" <?php qode_framework_inline_style( $title_styles ); ?>>
				<?php echo esc_html( $title ); ?>
				<?php echo '</' . esc_attr( $title_tag ); ?>>
			<?php endif; ?>
			<?php
		}

		public function get_title_styles( $atts ) {
			$styles = array();

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
