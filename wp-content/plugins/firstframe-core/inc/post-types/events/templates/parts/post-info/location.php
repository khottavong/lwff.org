<?php
$event_location = get_post_meta( get_the_ID(), 'qodef_event_single_location', true );

if ( ! empty( $event_location ) ) { ?>
	<div class="qodef-e-info-item qodef-info--location">
		<?php
		$label_params = array(
			'label'     => esc_html__( 'Location:', 'firstframe-core' ),
			'label_tag' => 'h5',
		);

		firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/label', '', $label_params );
		?>
		<span class="qodef-e-info-content"><?php echo esc_html( $event_location ); ?></span>
	</div>
<?php } ?>
