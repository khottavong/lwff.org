<?php
// Hook to include additional content before portfolio single item
do_action( 'firstframe_core_action_before_portfolio_single_item' );
?>
	<article <?php post_class( 'qodef-portfolio-single-item qodef-variations--small qodef-e' ); ?>>
		<div class="qodef-e-inner">
			<div class="qodef-e-content qodef-grid qodef-layout--template qodef-grid-template--8-4 <?php echo firstframe_core_get_grid_gutter_classes(); ?>">
				<div class="qodef-grid-inner">
					<div class="qodef-grid-item qodef-col--content">
						<div class="qodef-media">
							<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/media', 'masonry' ); ?>
						</div>
					</div>
					<div class="qodef-grid-item qodef-col--sidebar">
						<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/title', 'small' ); ?>
						<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
						<div class="qodef-portfolio-info">
							<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/date' ); ?>
							<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/categories' ); ?>
							<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/custom-fields' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php
// Hook to include additional content after portfolio single item
do_action( 'firstframe_core_action_after_portfolio_single_item' );
?>
