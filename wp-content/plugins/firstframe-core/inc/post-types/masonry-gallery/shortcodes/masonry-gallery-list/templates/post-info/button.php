<?php
$link = get_post_meta( get_the_ID(), 'qodef_masonry_gallery_item_link', true );

if ( ! empty( $link ) && class_exists( 'FirstFrameCore_Button_Shortcode' ) ) {
	$button_label = get_post_meta( get_the_ID(), 'qodef_masonry_gallery_item_button_label', true );
	$link_target  = get_post_meta( get_the_ID(), 'qodef_masonry_gallery_item_link_target', true );
	?>
	<div class="qodef-e-button">
		<?php
		$button_params = array(
			'button_layout' => 'textual',
			'link'          => $link,
			'target'        => $link_target,
			'text'          => ! empty( $button_label ) ? $button_label : esc_html__( 'Read More', 'firstframe-core' ),
		);

		echo FirstFrameCore_Button_Shortcode::call_shortcode( $button_params );
		?>
	</div>
<?php } ?>
