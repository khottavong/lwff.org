<div <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php firstframe_core_list_sc_template_part( 'post-types/events/shortcodes/events-list', 'post-info/date', '', $params ); ?>
		<div class="qodef-e-heading">
			<?php firstframe_core_list_sc_template_part( 'post-types/events/shortcodes/events-list', 'post-info/title', '', $params ); ?>
			<?php firstframe_core_list_sc_template_part( 'post-types/events/shortcodes/events-list', 'post-info/location', '', $params ); ?>
		</div>
		<?php firstframe_core_list_sc_template_part( 'post-types/events/shortcodes/events-list', 'post-info/tickets-link', '', $params ); ?>
	</div>
</div>
