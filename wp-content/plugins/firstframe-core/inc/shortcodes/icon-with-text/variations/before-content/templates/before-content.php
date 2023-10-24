<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-icon-wrapper" <?php qode_framework_inline_style( $image_styles ); ?>>
		<?php firstframe_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/' . $icon_type, '', $params ); ?>
	</div>
	<div class="qodef-m-content">
		<?php if ( ! empty( $params['link'] ) ) : ?>
			<a itemprop="url" href="<?php echo esc_url( $params['link'] ); ?>" target="<?php echo esc_attr( $target ); ?>">
		<?php endif; ?>
			<?php firstframe_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/title', '', $params ); ?>
			<?php firstframe_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/text', '', $params ); ?>
		<?php if ( ! empty( $params['link'] ) ) : ?>
			</a>
		<?php endif; ?>
	</div>
</div>
