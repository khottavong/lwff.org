<?php

if ( ! function_exists( 'firstframe_core_include_portfolio_single_related_posts_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function firstframe_core_include_portfolio_single_related_posts_template() {
		firstframe_core_template_part( 'post-types/portfolio', 'templates/single/related-posts/templates/related-posts' );
	}

	add_action( 'firstframe_core_action_after_portfolio_single_item', 'firstframe_core_include_portfolio_single_related_posts_template', 10 ); // permission 20 is set to define template position
}
