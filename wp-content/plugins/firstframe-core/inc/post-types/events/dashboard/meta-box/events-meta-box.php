<?php

if ( ! function_exists( 'firstframe_core_add_events_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function firstframe_core_add_events_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'event-item' ),
				'type'  => 'meta',
				'slug'  => 'event-item',
				'title' => esc_html__( 'Event Item', 'firstframe-core' ),
			)
		);

		if ( $page ) {

			/* General sections */

			$general_section = $page->add_section_element(
				array(
					'name'        => 'qodef_event_single_general_section',
					'title'       => esc_html__( 'General Settings', 'firstframe-core' ),
					'description' => esc_html__( 'General information about event single', 'firstframe-core' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_event_single_tickets_status',
					'title'       => esc_html__( 'Tickets Status', 'firstframe-core' ),
					'description' => esc_html__( 'Choose a tickets status for event single', 'firstframe-core' ),
					'options'     => array(
						'available' => esc_html__( 'Available', 'firstframe-core' ),
						'free'      => esc_html__( 'Free', 'firstframe-core' ),
						'sold'      => esc_html__( 'Sold', 'firstframe-core' ),
					),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'  => 'date',
					'name'        => 'qodef_event_single_start_date',
					'title'       => esc_html__( 'Event Start Date', 'firstframe-core' ),
					'description' => esc_html__( 'Enter event date', 'firstframe-core' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'  => 'date',
					'name'        => 'qodef_event_single_end_date',
					'title'       => esc_html__( 'Event End Date', 'firstframe-core' ),
					'description' => esc_html__( 'Enter event date', 'firstframe-core' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_event_single_time',
					'title'       => esc_html__( 'Event Time', 'firstframe-core' ),
					'description' => esc_html__( 'Enter the time in a HH:MM format. If you are using a 12 hour time format, please also enter AM or PM markers', 'firstframe-core' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_event_single_location',
					'title'       => esc_html__( 'Event Location', 'firstframe-core' ),
					'description' => esc_html__( 'Enter the event location. For example "Dolby Soho, Broadway New York"', 'firstframe-core' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_event_single_website',
					'title'      => esc_html__( 'Event Website', 'firstframe-core' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_event_single_organized_by',
					'title'      => esc_html__( 'Organized By', 'firstframe-core' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_event_single_tickets_link',
					'title'       => esc_html__( 'Buy Tickets Link', 'firstframe-core' ),
					'description' => esc_html__( 'Enter the external link where users can buy the tickets', 'firstframe-core' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_event_single_tickets_link_text',
					'title'      => esc_html__( 'Tickets Link Text', 'firstframe-core' ),
				)
			);

			$general_section->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_event_single_tickets_link_target',
					'title'      => esc_html__( 'Tickets Link Target', 'firstframe-core' ),
					'options'    => firstframe_core_get_select_type_options_pool( 'link_target' ),
				)
			);

			/* Social sections */

			$social_section = $page->add_section_element(
				array(
					'name'        => 'qodef_event_single_social_section',
					'title'       => esc_html__( 'Social Settings', 'firstframe-core' ),
					'description' => esc_html__( 'Social information about event single.', 'firstframe-core' ),
				)
			);

			$social_icons_repeater = $social_section->add_repeater_element(
				array(
					'name'        => 'qodef_events_single_social_icons',
					'title'       => esc_html__( 'Social Networks', 'firstframe-core' ),
					'description' => esc_html__( 'Populate events single social networks info', 'firstframe-core' ),
					'button_text' => esc_html__( 'Add New Network', 'firstframe-core' ),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_events_single_icon_source',
					'title'         => esc_html__( 'Team Member Icon Source', 'firstframe-core' ),
					'options'       => firstframe_core_get_select_type_options_pool( 'icon_source', false, array( 'predefined' ) ),
					'default_value' => 'svg_path',
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'iconpack',
					'name'       => 'qodef_events_single_icon',
					'title'      => esc_html__( 'Icon', 'firstframe-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_events_single_icon_source' => array(
								'values'        => 'icon_pack',
								'default_value' => 'svg_path',
							),
						),
					),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_events_single_svg_path',
					'title'       => esc_html__( 'Events Single Icon SVG Path', 'firstframe-core' ),
					'description' => esc_html__( 'Enter your search open icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'firstframe-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_events_single_icon_source' => array(
								'values'        => 'svg_path',
								'default_value' => 'svg_path',
							),
						),
					),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_events_single_icon_link',
					'title'      => esc_html__( 'Icon Link', 'firstframe-core' ),
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_events_single_icon_target',
					'title'      => esc_html__( 'Icon Target', 'firstframe-core' ),
					'options'    => firstframe_core_get_select_type_options_pool( 'link_target' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'firstframe_core_action_after_events_single_meta_box_map', $page );
		}
	}

	add_action( 'firstframe_core_action_default_meta_boxes_init', 'firstframe_core_add_events_single_meta_box' );
}
