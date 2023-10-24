<?php

class FirstFrameCore_Video_Button_Shortcode_Elementor extends FirstFrameCore_Elementor_Widget_Base {

	public function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'firstframe_core_video_button' );

		parent::__construct( $data, $args );
	}
}

firstframe_core_register_new_elementor_widget( new FirstFrameCore_Video_Button_Shortcode_Elementor() );
