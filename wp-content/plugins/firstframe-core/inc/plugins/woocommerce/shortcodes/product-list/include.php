<?php

include_once FIRSTFRAME_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/class-firstframecore-product-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
