<?php
$event_location = get_post_meta( get_the_ID(), 'qodef_event_single_location', true );

if ( ! empty( $event_location ) ) { ?>
	<p class="qodef-e-location"><?php echo esc_html( $event_location ); ?></p>
<?php } ?>
