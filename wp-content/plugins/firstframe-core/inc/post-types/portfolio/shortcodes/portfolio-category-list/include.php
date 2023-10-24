<?php

include_once FIRSTFRAME_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-category-list/class-firstframecore-portfolio-category-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-category-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
