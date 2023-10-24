<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/tabs/class-firstframecore-tab-shortcode.php';
include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/tabs/class-firstframecore-tab-child-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/tabs/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
