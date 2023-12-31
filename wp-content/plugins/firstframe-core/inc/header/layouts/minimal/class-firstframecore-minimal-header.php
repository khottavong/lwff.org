<?php

class FirstFrameCore_Minimal_Header extends FirstFrameCore_Header {
	private static $instance;

	public function __construct() {
		$this->set_layout( 'minimal' );
		$this->set_search_layout( 'fullscreen' );
		$this->default_header_height = 100;

		add_action( 'firstframe_action_before_wrapper_close_tag', array( $this, 'fullscreen_menu_template' ) );

		parent::__construct();
	}

	/**
	 * @return FirstFrameCore_Minimal_Header
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function fullscreen_menu_template() {
		$parameters = array(
			'fullscreen_menu_in_grid' => 'yes' === firstframe_core_get_post_value_through_levels( 'qodef_fullscreen_menu_in_grid' ),
		);

		firstframe_core_template_part( 'fullscreen-menu', 'templates/full-screen-menu', '', $parameters );
	}
}
