<?php
$styles = array();
if ( ! empty( $images_thumb_content_padding_top ) ) {
	$padding_top = qode_framework_string_ends_with_space_units( $images_thumb_content_padding_top ) ? $images_thumb_content_padding_top : intval( $images_thumb_content_padding_top ) . 'px';
	$styles[]    = 'padding-top:' . $padding_top;

}
if ( ! empty( $images_thumb_content_padding_bottom ) ) {
	$padding_bottom = qode_framework_string_ends_with_space_units( $images_thumb_content_padding_bottom ) ? $images_thumb_content_padding_bottom : intval( $images_thumb_content_padding_bottom ) . 'px';
	$styles[]       = 'padding-bottom:' . $padding_bottom;

}
?>
<div <?php qode_framework_class_attribute( $outer_holder_classes ); ?> <?php qode_framework_inline_style( $styles ); ?>>
	<?php if ( ! empty( $background_text ) ) : ?>
		<div class="qodef-bg-text">
			<?php

			for ( $i = 0; $i < 7; $i ++ ) {
				$text_marquee_params = array(
					'text_1'       => esc_html( $background_text ),
					'text_2'       => esc_html( $background_text ),
					'text_3'       => esc_html( $background_text ),
					'direction'    => 'left',
					'duration'     => '120s',
					'custom_class' => 'qodef-marquee-paused',
					'separator'    => '*',
				);

				if ( $i % 2 !== 0 ) {
					$text_marquee_params['direction'] = 'right';
					$text_marquee_params['duration']  = '100s';
				}

				echo FirstFrameCore_Text_Marquee_Shortcode::call_shortcode( $text_marquee_params );
			}
			?>
		</div>
	<?php endif; ?>
	<div class="qodef-swiper-container qodef-testimonials-thumbs" <?php qode_framework_inline_attr( $slider_thumb_attr, 'data-options' ); ?>>
		<div class="swiper-wrapper">
			<?php
			// Include items
			firstframe_core_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/loop-thumbs', '', $params );
			?>
		</div>
	</div>

	<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
		<?php firstframe_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/static-title', '', $params ); ?>
		<div class="swiper-wrapper">
			<?php
			// Include items
			firstframe_core_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/loop', '', $params );
			?>
		</div>

		<?php if ( 'no' !== $slider_pagination ) { ?>
			<?php firstframe_core_template_part( 'content', 'templates/swiper-pag', '', $params ); ?>
		<?php } ?>

	</div>

	<?php firstframe_core_template_part( 'content', 'templates/swiper-nav', '', $params ); ?>
</div>
