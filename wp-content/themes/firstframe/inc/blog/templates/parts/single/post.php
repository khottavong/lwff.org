<article <?php post_class( 'qodef-blog-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		firstframe_template_part( 'blog', 'templates/parts/post-info/media' );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-top-holder">
				<div class="qodef-e-info">
					<?php
					// Include post category info
					firstframe_template_part( 'blog', 'templates/parts/post-info/categories' );

					?>
				</div>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				firstframe_template_part( 'blog', 'templates/parts/post-info/title' );

				// Include post content
				the_content();

				// Hook to include additional content after blog single content
				do_action( 'firstframe_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-bottom-holder">
				<div class="qodef-e-left qodef-e-info">
					<?php
					// Include post author info
					firstframe_template_part( 'blog', 'templates/parts/post-info/tags' );

					?>
				</div>
				<div class="qodef-e-right qodef-e-info">
					<?php
					// Include post share info
					firstframe_template_part( 'blog', 'templates/parts/post-info/share' );

					?>
				</div>
			</div>
		</div>
	</div>
</article>
