<?php
$event_location = get_post_meta( get_the_ID(), 'qodef_event_single_location', true );

if ( ! empty( $event_location ) && class_exists( 'FirstFrameCore_Google_Map_Shortcode' ) ) { ?>
	<div class="qodef-e-map">
		<?php
		$params = array(
			'address1'   => $event_location,
			'map_height' => 426,
		);

		echo FirstFrameCore_Google_Map_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
