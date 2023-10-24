<?php
$website = get_post_meta( get_the_ID(), 'qodef_event_single_website', true );

if ( ! empty( $website ) ) { ?>
	<div class="qodef-e-info-item qodef-info--website">
		<?php
		$label_params = array(
			'label'     => esc_html__( 'Website:', 'firstframe-core' ),
			'label_tag' => 'h5',
		);

		firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/label', '', $label_params );
		?>
		<span class="qodef-e-info-content">
			<a itemprop="url" class="qodef-e-info-content-link" href="<?php echo esc_url( $website ); ?>"><?php echo esc_html( $website ); ?></a>
		</span>
	</div>
<?php } ?>
