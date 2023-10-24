<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/banner/class-firstframecore-banner-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
