<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/button/class-firstframecore-button-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
