<?php

if ( ! function_exists( 'firstframe_core_add_author_info_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function firstframe_core_add_author_info_widget( $widgets ) {
		$widgets[] = 'FirstFrameCore_Author_Info_Widget';

		return $widgets;
	}

	add_filter( 'firstframe_core_filter_register_widgets', 'firstframe_core_add_author_info_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class FirstFrameCore_Author_Info_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'firstframe_core_author_info' );
			$this->set_name( esc_html__( 'FirstFrame Author Info', 'firstframe-core' ) );
			$this->set_description( esc_html__( 'Add author info element into widget areas', 'firstframe-core' ) );
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'author_username',
					'title'      => esc_html__( 'Author Username', 'firstframe-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'author_color',
					'title'      => esc_html__( 'Author Color', 'firstframe-core' ),
				)
			);
		}

		public function render( $atts ) {
			$author_id = 1;
			if ( ! empty( $atts['author_username'] ) ) {
				$author = get_user_by( 'login', $atts['author_username'] );

				if ( ! empty( $author ) ) {
					$author_id = $author->ID;
				}
			}

			$author_link                 = get_author_posts_url( $author_id );
			$user_additional_information = get_the_author_meta( 'qodef_user_additional_information', $author_id );
			?>
			<div class="widget qodef-author-info">
				<a itemprop="url" class="qodef-author-info-image" href="<?php echo esc_url( $author_link ); ?>">
					<?php echo get_avatar( $author_id, 120 ); ?>
				</a>
				<div class="qodef-author-info-right">
					<h6 class="qodef-author-info-name vcard author">
						<a itemprop="url" href="<?php echo esc_url( $author_link ); ?>">
							<span class="fn"><?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ); ?></span>
						</a>
					</h6>
					<?php if ( ! empty ( $user_additional_information ) ) { ?>
						<p itemprop="additional-info" class="qodef-author-additional-information"><?php echo wp_kses_post( $user_additional_information ); ?></p>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	}
}
