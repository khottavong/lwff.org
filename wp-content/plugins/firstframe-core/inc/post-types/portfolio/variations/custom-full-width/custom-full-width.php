<?php

if ( ! function_exists( 'firstframe_core_add_portfolio_single_variation_custom_full_width' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_portfolio_single_variation_custom_full_width( $variations ) {
		$variations['custom-full-width'] = esc_html__( 'Custom Full Width', 'firstframe-core' );
		
		return $variations;
	}
	
	add_filter( 'firstframe_core_filter_portfolio_single_layout_options', 'firstframe_core_add_portfolio_single_variation_custom_full_width' );
}

if ( ! function_exists( 'firstframe_core_set_custom_full_width_page_inner_classes' ) ) {
	/**
	 * Function that changes classes for the page inner div from header.php
	 *
	 * @return string
	 */
	function firstframe_core_set_custom_full_width_page_inner_classes($classes) {
		$portfolio_type = get_post_meta( get_the_ID(), 'qodef_portfolio_single_layout', true );

		if ( 'custom-full-width' === $portfolio_type ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	add_filter( 'firstframe_filter_page_inner_classes', 'firstframe_core_set_custom_full_width_page_inner_classes' );
}

if ( ! function_exists( 'firstframe_core_set_custom_full_width_portfolio_related_classes' ) ) {
	/**
	 * Function that changes classes for portfolio related
	 *
	 * @return string
	 */
	function firstframe_core_set_custom_full_width_portfolio_related_classes($classes) {
		$portfolio_type = get_post_meta( get_the_ID(), 'qodef_portfolio_single_layout', true );

		if ( 'custom-full-width' === $portfolio_type ) {
			$classes = 'qodef-content-grid';
		}

		return $classes;
	}

	add_filter( 'firstframe_core_filter_portfolio_related_classes', 'firstframe_core_set_custom_full_width_portfolio_related_classes' );
}
