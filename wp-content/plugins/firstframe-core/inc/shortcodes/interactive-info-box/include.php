<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/interactive-info-box/class-firstframecore-interactive-info-box-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/interactive-info-box/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}