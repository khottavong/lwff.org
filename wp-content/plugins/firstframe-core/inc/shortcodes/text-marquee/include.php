<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/text-marquee/class-firstframecore-text-marquee-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_INC_PATH . '/shortcodes/text-marquee/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
