<?php
// Hook to include additional content before portfolio single item
do_action( 'firstframe_core_action_before_portfolio_single_item' );
?>
<article <?php post_class( 'qodef-portfolio-single-item qodef-e' ); ?>>
    <div class="qodef-e-inner">
        <div class="qodef-e-content">
            <div class="qodef-grid-inner">
	            <div class="qodef-grid-item qodef-col--content">
					<?php firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
                </div>
            </div>
        </div>
    </div>
</article>
<div class="qodef-single-portfolio-nav-holder qodef-content-grid">
	<?php
	// Hook to include additional content after portfolio single item
	do_action( 'firstframe_core_action_after_portfolio_single_item' );
	?>
</div>
