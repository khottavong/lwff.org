<?php

if ( ! function_exists( 'firstframe_core_add_portfolio_single_navigation_options' ) ) {
	/**
	 * Function that add additional custom post type single global options
	 *
	 * @param object $page
	 */
	function firstframe_core_add_portfolio_single_navigation_options( $page ) {

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_portfolio_enable_navigation',
					'title'         => esc_html__( 'Navigation', 'firstframe-core' ),
					'description'   => esc_html__( 'Enabling this option will turn on portfolio navigation functionality', 'firstframe-core' ),
					'default_value' => 'yes',
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_portfolio_navigation_through_same_category',
					'title'         => esc_html__( 'Navigation Through Same Category', 'firstframe-core' ),
					'description'   => esc_html__( 'Enabling this option will make portfolio navigation sort through current category', 'firstframe-core' ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'qodef_portfolio_enable_navigation' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							),
						),
					),
				)
			);
		}
	}

	add_action( 'firstframe_core_action_after_portfolio_options_single', 'firstframe_core_add_portfolio_single_navigation_options' );
}
