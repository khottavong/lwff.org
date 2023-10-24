<div class="qodef-grid-item <?php echo esc_attr( firstframe_core_get_page_content_sidebar_classes() ); ?>">
	<div class="qodef-events qodef-m">
		<?php
		// Include events posts loop
		firstframe_core_template_part( 'post-types/events', 'templates/parts/loop' );
		?>
	</div>
</div>
