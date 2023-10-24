<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>
		dir="<?php if ( $direction === 'left' ) { echo esc_html( 'ltr' ); } else { echo esc_html( 'rtl' );} ?>">
	<div class="swiper-wrapper">
		<?php
		// Include items
		firstframe_core_template_part( 'post-types/clients/shortcodes/clients-list', 'templates/loop', '', $params );
		?>
	</div>
	<?php firstframe_core_template_part( 'content', 'templates/swiper-nav', '', $params ); ?>
	<?php firstframe_core_template_part( 'content', 'templates/swiper-pag', '', $params ); ?>
</div>
