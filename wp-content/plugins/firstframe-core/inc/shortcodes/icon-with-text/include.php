<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/icon-with-text/class-firstframecore-icon-with-text-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/icon-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
