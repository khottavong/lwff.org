<?php if ( ! empty( $video ) ) { ?>
	<video id="qodef-404-video" autoplay muted loop>
		<source src="<?php echo wp_get_attachment_url( $video ); ?>" type="video/mp4">
	</video>
<?php } ?>
<?php if ( firstframe_is_installed( 'core' ) ) {
	$title = firstframe_core_get_post_value_through_levels( 'qodef_404_page_title' );
} ?>

<div id="qodef-404-page">
	<h1 class="qodef-404-subtitle"><?php echo esc_html( $subtitle ); ?></h1>

	<h1 class="qodef-404-title"><?php if ( firstframe_is_installed( 'core' ) ) {
			echo qode_framework_wp_kses_html( 'content', $title );
		} else {
			echo esc_html( $title );
		} ?></h1>

	<p class="qodef-404-text"><?php echo esc_html( $text ); ?></p>

	<div class="qodef-404-button">
		<?php
		$button_params = array(
			'link'          => esc_url( home_url( '/' ) ),
			'text'          => esc_html( $button_text ),
			'button_layout' => 'outlined',
		);

		firstframe_render_button_element( $button_params );
		?>
	</div>
</div>
