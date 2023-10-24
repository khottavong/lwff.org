<?php

include_once FIRSTFRAME_CORE_INC_PATH . '/blog/shortcodes/blog-list/class-firstframecore-blog-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_INC_PATH . '/blog/shortcodes/blog-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
