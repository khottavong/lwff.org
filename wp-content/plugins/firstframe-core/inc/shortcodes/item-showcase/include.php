<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/item-showcase/class-firstframecore-item-showcase-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/item-showcase/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
