<?php
/*
Template Name: Timetable Event
*/
get_header();

// Include event content template
if ( firstframe_is_installed( 'core' ) ) {
	firstframe_core_template_part( 'plugins/timetable', 'templates/content' );
}

get_footer();
