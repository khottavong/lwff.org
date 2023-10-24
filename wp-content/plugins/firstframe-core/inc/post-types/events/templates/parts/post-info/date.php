<?php
$event_date = get_post_meta( get_the_ID(), 'qodef_event_single_date', true );
$event_time = get_post_meta( get_the_ID(), 'qodef_event_single_time', true );

if ( ! empty( $event_date ) ) { ?>
	<div class="qodef-e-info-item qodef-info--date">
		<?php
		$label_params = array(
			'label'     => esc_html__( 'Date:', 'firstframe-core' ),
			'label_tag' => 'h5',
		);

		firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/label', '', $label_params );
		?>
		<span class="qodef-e-info-content">
			<?php
			echo esc_html( $event_date );

			if ( ! empty( $event_time ) ) {
				echo esc_html( $event_time );
			}
			?>
		</span>
	</div>
<?php } ?>
