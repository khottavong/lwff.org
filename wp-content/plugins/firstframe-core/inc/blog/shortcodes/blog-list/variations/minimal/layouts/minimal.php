<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-content">
            <div class="qodef-e-top-holder">
				<div class="qodef-e-info">
					<?php
					// Include post category info
					firstframe_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );
					 // Include post category info
                    firstframe_core_theme_template_part('blog', 'templates/parts/post-info/categories');
					?>
				</div>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				firstframe_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params );
				?>
			</div>
			<div class="qodef-e-bottom-holder">
				<div class="qodef-e-info">
					<?php
					// Include post category info
					firstframe_core_theme_template_part( 'blog', 'templates/parts/post-info/read-more' );
					?>
				</div>
			</div>
		</div>
	</div>
</article>