<?php

include_once FIRSTFRAME_CORE_CPT_PATH . '/masonry-gallery/shortcodes/masonry-gallery-list/class-firstframecore-masonry-gallery-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_CPT_PATH . '/masonry-gallery/shortcodes/masonry-gallery-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
