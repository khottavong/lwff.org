<?php
$organized_by = get_post_meta( get_the_ID(), 'qodef_event_single_organized_by', true );

if ( ! empty( $organized_by ) ) { ?>
	<div class="qodef-e-info-item qodef-info--organized-by">
		<?php
		$label_params = array(
			'label'     => esc_html__( 'Organized By:', 'firstframe-core' ),
			'label_tag' => 'h5',
		);

		firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/label', '', $label_params );
		?>
		<span class="qodef-e-info-content"><?php echo esc_html( $organized_by ); ?></span>
	</div>
<?php } ?>
