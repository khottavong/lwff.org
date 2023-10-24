<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/author-list/helper.php';
include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/author-list/class-firstframecore-author-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_INC_PATH . '/shortcodes/author-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
