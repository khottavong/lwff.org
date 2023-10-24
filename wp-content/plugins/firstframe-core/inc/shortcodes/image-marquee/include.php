<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/image-marquee/class-firstframecore-image-marquee-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_INC_PATH . '/shortcodes/image-marquee/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
