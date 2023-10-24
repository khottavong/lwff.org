<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/counter/class-firstframecore-counter-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/counter/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
