<?php
$event_date = get_post_meta( get_the_ID(), 'qodef_event_single_date', true );

if ( ! empty( $event_date ) ) {
	$date = explode( '-', $event_date );
	?>
	<span class="qodef-e-date">
		<?php echo gmdate( 'd M', mktime( 0, 0, 0, $date[1], $date[2], $date[0] ) ); ?>
	</span>
<?php } ?>
