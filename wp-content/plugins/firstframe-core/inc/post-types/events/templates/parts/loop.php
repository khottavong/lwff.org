<?php

if ( have_posts() ) {
	while ( have_posts() ) :
		the_post();

		// Hook to include additional content before post item
		do_action( 'firstframe_core_action_before_events_item' );

		$item_layout = apply_filters( 'firstframe_core_filter_events_single_layout', '' );

		// Include post item
		firstframe_core_template_part( 'post-types/events', 'templates/layouts/' . $item_layout );

		// Hook to include additional content after post item
		do_action( 'firstframe_core_action_after_events_item' );

	endwhile; // End of the loop.
} else {
	// Include global posts not found
	firstframe_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();
