<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/stacked-images/class-firstframecore-stacked-images-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/stacked-images/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
