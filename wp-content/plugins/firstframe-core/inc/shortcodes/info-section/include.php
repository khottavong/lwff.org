<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/info-section/class-firstframecore-info-section-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/info-section/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
