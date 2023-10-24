<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/awards-list/class-firstframe-awards-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/awards-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}