<?php

if ( ! function_exists( 'firstframe_core_add_portfolio_single_variation_masonry_small' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_portfolio_single_variation_masonry_small( $variations ) {
		$variations['masonry-small'] = esc_html__( 'Masonry - Small', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_portfolio_single_layout_options', 'firstframe_core_add_portfolio_single_variation_masonry_small' );
}

if ( ! function_exists( 'firstframe_core_include_masonry_for_portfolio_single_variation_masonry_small' ) ) {
	/**
	 * Function that include masonry scripts for current module layout
	 *
	 * @param string $post_type
	 *
	 * @return string
	 */
	function firstframe_core_include_masonry_for_portfolio_single_variation_masonry_small( $post_type ) {
		$portfolio_template = firstframe_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' );

		if ( 'masonry-small' === $portfolio_template ) {
			$post_type = 'portfolio-item';
		}

		return $post_type;
	}

	add_filter( 'firstframe_filter_allowed_post_type_to_enqueue_masonry_scripts', 'firstframe_core_include_masonry_for_portfolio_single_variation_masonry_small' );
}
