<div <?php qode_framework_class_attribute( $outer_holder_classes ); ?>>
	<?php if ( ! empty( $background_text ) ) { ?>
		<div class="qodef-bg-text">
			<?php

			for ( $i = 0; $i < 7; $i ++ ) {
				$text_marquee_params = array(
					'text_1'       => esc_html( $background_text ),
					'text_2'       => esc_html( $background_text ),
					'text_3'       => esc_html( $background_text ),
					'direction'    => 'left',
					'duration'     => '60s',
					'custom_class' => 'qodef-marquee-paused',
					'separator'    => '*',
				);

				if ( $i % 2 !== 0 ) {
					$text_marquee_params['direction'] = 'right';
					$text_marquee_params['duration']  = '40s';
				}

				echo FirstFrameCore_Text_Marquee_Shortcode::call_shortcode( $text_marquee_params );
			}
			?>
		</div>
	<?php } ?>
	<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
		<div class="swiper-wrapper">
			<?php
			// Include items
			if ( ! empty( $images ) ) {
				foreach ( $images as $image ) {
					firstframe_core_template_part( 'shortcodes/image-gallery', 'templates/parts/image', '', array_merge( $params, $image ) );
				}
			}
			?>
		</div>
		<?php firstframe_core_template_part( 'content', 'templates/swiper-nav', '', $params ); ?>
		<?php firstframe_core_template_part( 'content', 'templates/swiper-pag', '', $params ); ?>
	</div>
</div>
