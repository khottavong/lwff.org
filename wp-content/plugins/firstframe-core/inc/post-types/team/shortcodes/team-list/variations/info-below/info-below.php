<?php

if ( ! function_exists( 'firstframe_core_add_team_list_variation_info_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function firstframe_core_add_team_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'firstframe-core' );

		return $variations;
	}

	add_filter( 'firstframe_core_filter_team_list_layouts', 'firstframe_core_add_team_list_variation_info_below' );
}

if ( ! function_exists( 'firstframe_core_add_team_list_options_info_below' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function firstframe_core_add_team_list_options_info_below( $options ) {
		$info_below_options   = array();
		$margin_option        = array(
			'field_type' => 'text',
			'name'       => 'info_below_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'firstframe-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-below',
						'default_value' => 'default',
					),
				),
			),
			'group'      => esc_html__( 'Layout', 'firstframe-core' ),
		);
		$info_below_options[] = $margin_option;

		return array_merge( $options, $info_below_options );
	}

	add_filter( 'firstframe_core_filter_team_list_extra_options', 'firstframe_core_add_team_list_options_info_below' );
}
