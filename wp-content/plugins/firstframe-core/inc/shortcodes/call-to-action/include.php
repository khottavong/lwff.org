<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/call-to-action/class-firstframecore-call-to-action-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/call-to-action/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
