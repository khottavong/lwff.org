<article <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php firstframe_core_template_part( 'post-types/portfolio/shortcodes/portfolio-category-list', 'templates/parts/image', '', $params ); ?>
		<div class="qodef-e-content">
			<?php firstframe_core_template_part( 'post-types/portfolio/shortcodes/portfolio-category-list', 'templates/parts/title', '', $params ); ?>
			<?php firstframe_core_template_part( 'post-types/portfolio/shortcodes/portfolio-category-list', 'templates/parts/description', '', $params ); ?>
		</div>
		<?php firstframe_core_template_part( 'post-types/portfolio/shortcodes/portfolio-category-list', 'templates/parts/link', '', $params ); ?>
	</div>
</article>
