<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/image-with-text/class-firstframecore-image-with-text-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/image-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
