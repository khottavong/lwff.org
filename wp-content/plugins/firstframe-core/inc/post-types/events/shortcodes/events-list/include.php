<?php

include_once FIRSTFRAME_CORE_CPT_PATH . '/events/shortcodes/events-list/class-firstframecore-events-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_CPT_PATH . '/events/shortcodes/events-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
