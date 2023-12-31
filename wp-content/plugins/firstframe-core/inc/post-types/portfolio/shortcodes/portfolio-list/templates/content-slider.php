<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<div class="swiper-wrapper">
		<?php
		// Include items
		firstframe_core_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/loop', '', $params );
		?>
	</div>

	<?php if ( 'yes' === $full_screen_slider && ! empty( $fullscreen_widget_area ) && is_active_sidebar( $fullscreen_widget_area ) ) : ?>
	<div class="qodef-fullscreen-slider-widget-area">
		<?php dynamic_sidebar( $fullscreen_widget_area ); ?>
	</div>
	<?php endif; ?>
	<?php firstframe_core_template_part( 'content', 'templates/swiper-nav', '', $params ); ?>
	<?php firstframe_core_template_part( 'content', 'templates/swiper-pag', '', $params ); ?>
</div>
