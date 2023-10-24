<?php

if ( ! function_exists( 'firstframe_core_register_events_for_meta_options' ) ) {
	/**
	 * Function that add custom post type into global meta box allowed items array for saving meta box options
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function firstframe_core_register_events_for_meta_options( $post_types ) {
		$post_types[] = 'event-item';

		return $post_types;
	}

	add_filter( 'qode_framework_filter_meta_box_save', 'firstframe_core_register_events_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'firstframe_core_register_events_for_meta_options' );
}

if ( ! function_exists( 'firstframe_core_add_events_custom_post_type' ) ) {
	/**
	 * Function that adds events custom post type
	 *
	 * @param array $cpts
	 *
	 * @return array
	 */
	function firstframe_core_add_events_custom_post_type( $cpts ) {
		$cpts[] = 'FirstFrameCore_Events_CPT';

		return $cpts;
	}

	add_filter( 'firstframe_core_filter_register_custom_post_types', 'firstframe_core_add_events_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class FirstFrameCore_Events_CPT extends QodeFrameworkCustomPostType {

		public function map_post_type() {
			$name = esc_html__( 'Events', 'firstframe-core' );
			$this->set_base( 'event-item' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-calendar-alt' );
			$this->set_slug( 'event-item' );
			$this->set_name( $name );
			$this->set_path( FIRSTFRAME_CORE_CPT_PATH . '/events' );
			$this->set_labels(
				array(
					'name'          => esc_html__( 'FirstFrame Events', 'firstframe-core' ),
					'singular_name' => esc_html__( 'Event Item', 'firstframe-core' ),
					'add_item'      => esc_html__( 'New Event Item', 'firstframe-core' ),
					'add_new_item'  => esc_html__( 'Add New Event Item', 'firstframe-core' ),
					'edit_item'     => esc_html__( 'Edit Event Item', 'firstframe-core' ),
				)
			);
			$this->set_supports(
				array(
					'title',
					'thumbnail',
					'editor',
				)
			);
			$this->add_post_taxonomy(
				array(
					'base'          => 'event-types',
					'slug'          => 'event-types',
					'singular_name' => esc_html__( 'Type', 'firstframe-core' ),
					'plural_name'   => esc_html__( 'Types', 'firstframe-core' ),
				)
			);
		}
	}
}
