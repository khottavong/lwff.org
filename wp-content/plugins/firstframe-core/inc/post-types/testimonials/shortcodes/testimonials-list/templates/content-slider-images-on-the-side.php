<div <?php qode_framework_class_attribute( $holder_classes ); ?>>

	<div class="qodef-testimonials-images-on-the-side">
		<div class="qodef-testimonials-images-holder">
			<?php
			// Include items
			firstframe_core_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/loop-images-on-the-side', '', $params );
			?>
			<div class="qodef-testimonials-quote">
				<?php echo firstframe_core_get_svg_icon( 'quote-dark' ); ?>
			</div>
		</div>

	</div>

	<div class="qodef-custom-testimonials-swiper-wrapper qodef-swiper-container" <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>

		<div class="swiper-wrapper">
			<?php
			// Include items
			firstframe_core_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/loop', '', $params );
			?>

		</div>

		<?php firstframe_core_template_part( 'content', 'templates/swiper-pag', '', $params ); ?>
	</div>

</div>

