<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-grid-inner">
		<?php
		// Include global masonry template from theme
		firstframe_core_theme_template_part( 'masonry', 'templates/sizer-gutter', '', $params['behavior'] );

		// Include items
		firstframe_core_template_part( 'post-types/portfolio/shortcodes/portfolio-category-list', 'templates/loop', '', $params );
		?>
	</div>
</div>
