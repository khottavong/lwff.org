<?php
// Load title image template
firstframe_core_get_page_title_image();
?>
<div class="qodef-m-content <?php echo esc_attr( firstframe_core_get_page_title_content_classes() ); ?>">
	<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title entry-title">
		<?php
		if ( qode_framework_is_installed( 'theme' ) ) {
			echo qode_framework_wp_kses_html( 'content', firstframe_get_page_title_text() );
		} else {
			echo get_option( 'blogname' );
		}
		?>
	</<?php echo esc_attr( $title_tag ); ?>>
	<?php
	// Load breadcrumbs template
	firstframe_core_breadcrumbs();
	?>
</div>
