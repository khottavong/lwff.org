<?php

include_once FIRSTFRAME_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/class-firstframecore-testimonials-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
