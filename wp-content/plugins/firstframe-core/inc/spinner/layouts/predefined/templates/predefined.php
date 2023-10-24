<?php
$spinner_text  = firstframe_core_get_post_value_through_levels( 'qodef_page_spinner_text' );
$unique_id = 'qodef-cicle-path-' . rand( 0, 1000 );
?>

<div class="qodef-m-spinner-stamp">
	<div class="qodef-m-spinner-stamp-inner">
		<svg class="qodef-circle-svg" xmlns="http://www.w3.org/2000/svg" width="144" height="144" viewBox="0 0 144 144">
			<path id="<?php echo esc_attr( $unique_id ) ?>" fill="none" d="M16,72a56,56,0,1,1,56,56A56,56,0,0,1,16,72" />
			<text class="qodef-circle-text">
				<textPath xlink:href="#<?php echo esc_attr( $unique_id ) ?>"><?php echo esc_attr__( $spinner_text . ' ○ ' . $spinner_text . ' ○ '. $spinner_text . ' ○ ', 'firstframe-core' ) ?></textPath>
			</text>
		</svg>
		<div class="qodef-m-stamp-static"><?php firstframe_render_svg_icon( 'asterix' ); ?></div>
	</div>
</div>

