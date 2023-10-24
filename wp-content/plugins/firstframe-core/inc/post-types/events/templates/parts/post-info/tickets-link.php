<?php
$page_id        = get_the_ID();
$tickets_status = get_post_meta( $page_id, 'qodef_event_single_tickets_status', true );

if ( ! empty( $tickets_status ) ) {
	$tickets_link        = get_post_meta( $page_id, 'qodef_event_single_tickets_link', true );
	$tickets_link_text   = get_post_meta( $page_id, 'qodef_event_single_tickets_link_text', true );
	$tickets_link_target = get_post_meta( $page_id, 'qodef_event_single_tickets_link_target', true );

	$holder_classes = array( 'qodef-status--' . $tickets_status );
	?>
	<div class="qodef-e-tickets-link <?php echo esc_attr( implode( ' ', $holder_classes ) ); ?>">
		<?php
		switch ( $tickets_status ) {
			case 'available':
				$params = array(
					'button_layout' => 'filled',
					'text'          => ! empty( $tickets_link_text ) ? $tickets_link_text : esc_html__( 'Buy Ticket', 'firstframe-core' ),
					'link'          => $tickets_link,
					'target'        => $tickets_link_target,
				);

				echo FirstFrameCore_Button_Shortcode::call_shortcode( $params );
				break;
			case 'free':
				?>
				<span class="qodef-e-tickets-link-label"><?php esc_html_e( 'Free', 'firstframe-core' ); ?></span>
				<?php
				break;
			case 'sold':
				?>
				<span class="qodef-e-tickets-link-label"><?php esc_html_e( 'Sold', 'firstframe-core' ); ?></span>
				<?php
				break;
		}
		?>
	</div>
<?php } ?>
