<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/single-image/class-firstframecore-single-image-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/single-image/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
