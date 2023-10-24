<?php
// Hook to include additional content before portfolio single item
do_action( 'firstframe_core_action_before_portfolio_single_item' );
?>
	<article <?php post_class( 'qodef-portfolio-single-item qodef-variations--big qodef-e' ); ?>>
		<div class="qodef-e-inner">
			<div class="qodef-media qodef-swiper-container qodef--slider">
				<div class="swiper-wrapper">
					<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/media', 'slider' ); ?>
				</div>
				<?php firstframe_core_template_part( 'content', 'templates/swiper-nav', '', array( 'slider_navigation' => 'yes' ) ); ?>
			</div>
			<div class="qodef-e-content qodef-grid qodef-layout--template <?php echo firstframe_core_get_grid_gutter_classes(); ?>">
				<div class="qodef-grid-inner">
					<div class="qodef-grid-item qodef-col--content">
						<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/title' ); ?>
						<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
					</div>
					<div class="qodef-grid-item qodef-col--sidebar qodef-portfolio-info">
						<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/date' ); ?>
						<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/categories' ); ?>
						<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/custom-fields' ); ?>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php
// Hook to include additional content after portfolio single item
do_action( 'firstframe_core_action_after_portfolio_single_item' );
?>
