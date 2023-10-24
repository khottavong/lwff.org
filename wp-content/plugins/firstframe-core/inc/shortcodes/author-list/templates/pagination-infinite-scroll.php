<?php if ( isset( $query_result ) && intval( $max_num_pages ) > 1 ) { ?>
	<div class="qodef-m-pagination qodef--infinite-scroll">
		<?php
		// Include loading spinner
		firstframe_core_render_svg_icon( 'spinner', 'qodef-m-pagination-spinner' );
		?>
	</div>
<?php } ?>
