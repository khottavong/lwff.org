<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner" <?php qode_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ); ?>>
		<div class="qodef-e-media">
			<?php firstframe_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/image', '', $params ); ?>
		</div>
		<div class="qodef-e-content">

			<div class="qodef-e-bottom-holder">
				<div class="qodef-e-text">
					<?php
					// Include post title
					firstframe_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/title', '', $params );
					?>
				</div>
				<div class="qodef-e-info">
					<?php
					// Include post category info
					firstframe_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/categories', '', $params );

					firstframe_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/video-meta', '', $params );
					?>
				</div>
			</div>
		</div>
		<?php firstframe_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/link' ); ?>
	</div>
</article>
