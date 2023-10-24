<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/accordion/class-firstframecore-accordion-shortcode.php';
include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/accordion/class-firstframecore-accordion-child-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/accordion/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
