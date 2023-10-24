<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/vertical-split-slider/helper.php';
include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/vertical-split-slider/class-firstframecore-vertical-split-slider-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/vertical-split-slider/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
