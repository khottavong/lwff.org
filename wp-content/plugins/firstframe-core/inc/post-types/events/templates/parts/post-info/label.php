<?php
$label     = isset( $label ) ? $label : '';
$label_tag = isset( $label_tag ) && ! empty( $label_tag ) ? $label_tag : 'h3';

if ( ! empty( $label ) ) {
	$label_class = 'qodef--' . strtolower( str_replace( ' ', '-', $label ) );
	?>
	<<?php echo esc_attr( $label_tag ); ?> class="qodef-e-label <?php echo esc_attr( $label_class ); ?>"><?php echo esc_html( $label ); ?></<?php echo esc_attr( $label_tag ); ?>>
<?php } ?>
