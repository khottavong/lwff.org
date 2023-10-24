<div class="qodef-portfolio-project-info">
	<?php
	// Include title
	firstframe_core_template_part( 'post-types/portfolio/shortcodes/portfolio-project-info', 'templates/parts/label', '', $params );

	// Include info
	?>
	<div class="qodef-e-info">
		<?php if ( 'yes' === $custom_text_option && ! empty( $custom_text ) ) { ?>
			<span class="qodef-e-custom-text"><?php echo esc_attr( $custom_text ); ?></span>
		<?php } else {
			firstframe_core_template_part( 'post-types/portfolio/shortcodes/portfolio-project-info', 'templates/parts/' . $params['project_info_type'], '', $params );
		}
		?>
	</div>
</div>
