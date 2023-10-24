<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/countdown/class-firstframecore-countdown-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/countdown/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
