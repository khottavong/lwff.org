<?php

include_once FIRSTFRAME_CORE_CPT_PATH . '/team/shortcodes/team-list/class-firstframecore-team-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_CPT_PATH . '/team/shortcodes/team-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
