<article <?php post_class( 'qodef-event-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-info">
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/image' ); ?>
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/label', '', array( 'label' => esc_html__( 'Details:', 'firstframe-core' ) ) ); ?>
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/date' ); ?>
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/location' ); ?>
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/website' ); ?>
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/event-types' ); ?>
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/organized-by' ); ?>
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/tickets-link' ); ?>
		</div>
		<div class="qodef-e-content">
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/map' ); ?>
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/label', '', array( 'label' => esc_html__( 'About event', 'firstframe-core' ) ) ); ?>
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/content' ); ?>
			<?php firstframe_core_template_part( 'post-types/events', 'templates/parts/post-info/social-icons' ); ?>
		</div>
	</div>
</article>
