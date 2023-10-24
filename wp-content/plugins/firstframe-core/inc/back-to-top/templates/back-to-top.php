<?php
$custom_icon    = firstframe_core_get_custom_svg_opener_icon_html( 'back_to_top' );
$holder_classes = array();
if ( empty( $custom_icon ) ) {
	$holder_classes[] = 'qodef--predefined';
}
?>
<a id="qodef-back-to-top" href="#" <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<span class="qodef-back-to-top-icon">
		<?php
		if ( ! empty( $custom_icon ) ) {
			echo firstframe_core_get_custom_svg_opener_icon_html( 'back_to_top' );
		} else {
			$unique_id = 'qodef-cicle-path-' . rand( 0, 1000 );
			?>
			<svg class="qodef-circle-svg" xmlns="http://www.w3.org/2000/svg" width="100" height="100"
			     viewBox="0 0 100 100">
				<path id="<?php echo esc_attr( $unique_id ) ?>" fill="none"
				      d="M12,50a38,38,0,1,1,38,38A38,38,0,0,1,12,50"/>
				<g class="qodef-circle-text-holder">
					<text class="qodef-circle-text">
					<textPath
							xlink:href="#<?php echo esc_attr( $unique_id ) ?>"><?php echo esc_attr__( 'BACK TO TOP ○ BACK TO TOP ○ BACK TO TOP ○', 'firstframe-core' ) ?></textPath>
					</text>
				</g>
				<g class="qodef-arrow">
					<g>
						<path class="qodef-arrow-vertical" d="m50,38v24"/>
						<path class="qodef-arrow-horizontal" d="M37.6,50.4L50,38l12.4,12.4"/>
					</g>
					<g>
						<path class="qodef-arrow-vertical" d="m50,38v24"/>
						<path class="qodef-arrow-horizontal" d="M37.6,50.4L50,38l12.4,12.4"/>
					</g>
				</g>
			</svg>
		<?php }
		?>
	</span>
</a>
