<div class="qodef-e qodef-info--social-share">
	<?php if ( class_exists( 'FirstFrameCore_Social_Share_Shortcode' ) ) {
		$params = array(
			'layout' => 'text'
		);

		echo FirstFrameCore_Social_Share_Shortcode::call_shortcode( $params );
	} ?>
</div>
