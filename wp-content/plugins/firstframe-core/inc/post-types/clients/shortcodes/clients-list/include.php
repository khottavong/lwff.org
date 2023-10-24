<?php

include_once FIRSTFRAME_CORE_CPT_PATH . '/clients/shortcodes/clients-list/class-firstframecore-clients-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
