<?php

if ( ! class_exists( 'FirstFrameCore_WooCommerce_YITH_Wishlist' ) ) {
	class FirstFrameCore_WooCommerce_YITH_Wishlist {
		private static $instance;

		public function __construct() {

			if ( qode_framework_is_installed( 'yith-wishlist' ) ) {
				// Init
				add_action( 'after_setup_theme', array( $this, 'init' ) );
			}
		}

		/**
		 * @return FirstFrameCore_WooCommerce_YITH_Wishlist
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init() {

			// Change default templates position
			$this->change_templates_position();

			// Disable default resopnsive YITH Wishlist Page Table
			add_filter( 'yith_wcwl_is_wishlist_responsive', array( $this, 'is_responsive' ) );
		}

		function change_templates_position() {

			// Add button element for shop pages
			add_action( 'firstframe_action_product_list_item_additional_hover_content', 'firstframe_core_get_yith_wishlist_shortcode' );
			add_action( 'firstframe_core_action_product_list_item_additional_hover_content', 'firstframe_core_get_yith_wishlist_shortcode' );
		}

		function is_responsive() {

			// Prevent from using wp_is_mobile and rendering responsive list instead of regular cart table
			return false;
		}
	}

	FirstFrameCore_WooCommerce_YITH_Wishlist::get_instance();
}
