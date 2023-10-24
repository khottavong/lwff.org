<?php
$term_values = get_the_terms( get_the_ID(), 'event-types' );

if ( ! empty( $term_values ) && ! is_wp_error( $term_values ) ) { ?>
	<div class="qodef-e-info-item qodef-info--event-types">
		<?php
		$label_params = array(
			'label'     => esc_html__( 'Event Types:', 'firstframe-core' ),
			'label_tag' => 'h5',
		);

		firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/label', '', $label_params );
		?>
		<span class="qodef-e-info-content">
			<?php foreach ( $term_values as $term_value ) { ?>
				<a itemprop="url" class="qodef-e-info-content-link" href="<?php echo esc_url( get_term_link( $term_value->term_id ) ); ?>"><?php echo esc_html( $term_value->name ); ?></a>
			<?php } ?>
		</span>
	</div>
<?php } ?>
