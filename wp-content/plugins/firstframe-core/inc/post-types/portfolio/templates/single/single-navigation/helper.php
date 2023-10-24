<?php

if ( ! function_exists( 'firstframe_core_include_portfolio_single_post_navigation_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function firstframe_core_include_portfolio_single_post_navigation_template() {
		firstframe_core_template_part( 'post-types/portfolio', 'templates/single/single-navigation/templates/single-navigation' );
	}

	add_action( 'firstframe_core_action_after_portfolio_single_item', 'firstframe_core_include_portfolio_single_post_navigation_template' );
}
