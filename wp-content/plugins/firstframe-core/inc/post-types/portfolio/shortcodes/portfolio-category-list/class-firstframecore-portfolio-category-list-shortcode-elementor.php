<?php

class FirstFrameCore_Portfolio_Category_List_Shortcode_Elementor extends FirstFrameCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'firstframe_core_portfolio_category_list' );

		parent::__construct( $data, $args );
	}
}

firstframe_core_register_new_elementor_widget( new FirstFrameCore_Portfolio_Category_List_Shortcode_Elementor() );
