<?php if ( ! empty( $button_params ) && class_exists( 'FirstFrameCore_Button_Shortcode' ) ) { ?>
	<div class="qodef-m-button">
		<?php echo FirstFrameCore_Button_Shortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>
