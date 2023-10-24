<?php

if ( ! function_exists( 'firstframe_core_register_portfolio_for_meta_options' ) ) {
	/**
	 * Function that add custom post type into global meta box allowed items array for saving meta box options
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function firstframe_core_register_portfolio_for_meta_options( $post_types ) {
		$post_types[] = 'portfolio-item';

		return $post_types;
	}

	add_filter( 'qode_framework_filter_meta_box_save', 'firstframe_core_register_portfolio_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'firstframe_core_register_portfolio_for_meta_options' );
}

if ( ! function_exists( 'firstframe_core_add_portfolio_custom_post_type' ) ) {
	/**
	 * Function that adds portfolio custom post type
	 *
	 * @param array $cpts
	 *
	 * @return array
	 */
	function firstframe_core_add_portfolio_custom_post_type( $cpts ) {
		$cpts[] = 'FirstFrameCore_Portfolio_CPT';

		return $cpts;
	}

	add_filter( 'firstframe_core_filter_register_custom_post_types', 'firstframe_core_add_portfolio_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class FirstFrameCore_Portfolio_CPT extends QodeFrameworkCustomPostType {

		public function map_post_type() {
			$name = esc_html__( 'Portfolio', 'firstframe-core' );
			$this->set_base( 'portfolio-item' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-format-gallery' );
			$this->set_slug( 'portfolio-item' );
			$this->set_name( $name );
			$this->set_path( FIRSTFRAME_CORE_CPT_PATH . '/portfolio' );
			$this->set_labels(
				array(
					'name'          => esc_html__( 'FirstFrame Portfolio', 'firstframe-core' ),
					'singular_name' => esc_html__( 'Portfolio Item', 'firstframe-core' ),
					'add_item'      => esc_html__( 'New Portfolio Item', 'firstframe-core' ),
					'add_new_item'  => esc_html__( 'Add New Portfolio Item', 'firstframe-core' ),
					'edit_item'     => esc_html__( 'Edit Portfolio Item', 'firstframe-core' ),
				)
			);
			$this->add_post_taxonomy(
				array(
					'base'          => 'portfolio-category',
					'slug'          => 'portfolio-category',
					'singular_name' => esc_html__( 'Category', 'firstframe-core' ),
					'plural_name'   => esc_html__( 'Categories', 'firstframe-core' ),
				)
			);
			$this->add_post_taxonomy(
				array(
					'base'          => 'portfolio-tag',
					'slug'          => 'portfolio-tag',
					'singular_name' => esc_html__( 'Tag', 'firstframe-core' ),
					'plural_name'   => esc_html__( 'Tags', 'firstframe-core' ),
				)
			);
		}
	}
}
