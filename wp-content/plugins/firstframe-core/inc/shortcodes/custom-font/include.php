<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/custom-font/class-firstframecore-custom-font-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
