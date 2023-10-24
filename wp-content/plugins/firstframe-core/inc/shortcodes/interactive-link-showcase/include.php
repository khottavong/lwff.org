<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/interactive-link-showcase/class-firstframecore-interactive-link-showcase-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/interactive-link-showcase/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
