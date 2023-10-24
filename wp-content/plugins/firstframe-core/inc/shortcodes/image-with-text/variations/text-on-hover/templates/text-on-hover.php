<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		if ( count( $image_params ) ) {
			firstframe_core_template_part( 'shortcodes/image-with-text', 'templates/parts/image', '', $params );
		}
		?>
		<div class="qodef-m-content">
			<div class="qodef-e-top-holder">
				<div class="qodef-e-info">
					<?php

					firstframe_core_template_part( 'shortcodes/image-with-text', 'templates/parts/number', '', $params );
					?>
				</div>
			</div>
			<div class="qodef-e-text">
				<?php firstframe_core_template_part( 'shortcodes/image-with-text', 'templates/parts/title', '', $params ); ?>
			</div>

		</div>
	</div>
</div>
