<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/pricing-table/class-firstframecore-pricing-table-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/pricing-table/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
