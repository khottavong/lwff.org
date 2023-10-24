<?php

include_once FIRSTFRAME_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/helper.php';
include_once FIRSTFRAME_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/class-firstframecore-portfolio-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
