<?php
// Hook to include additional content before page content holder
do_action( 'firstframe_core_action_before_team_content_holder' );
?>
	<main id="qodef-page-content" class="qodef-grid qodef-layout--template <?php echo esc_attr( firstframe_core_get_page_grid_sidebar_classes() ); ?> <?php echo esc_attr( firstframe_core_get_grid_gutter_classes() ); ?>" role="main">
		<div class="qodef-grid-inner">
			<?php
			// Include team template
			$template_slug = isset( $template_slug ) ? $template_slug : '';
			firstframe_core_template_part( 'post-types/team', 'templates/team', $template_slug );

			// Include page content sidebar
			firstframe_core_theme_template_part( 'sidebar', 'templates/sidebar' );
			?>
		</div>
	</main>
<?php
// Hook to include additional content after main page content holder
do_action( 'firstframe_core_action_after_team_content_holder' );
?>
