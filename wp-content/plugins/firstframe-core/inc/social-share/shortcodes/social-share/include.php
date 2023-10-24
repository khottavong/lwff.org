<?php

include_once FIRSTFRAME_CORE_INC_PATH . '/social-share/shortcodes/social-share/class-firstframecore-social-share-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_INC_PATH . '/social-share/shortcodes/social-share/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
