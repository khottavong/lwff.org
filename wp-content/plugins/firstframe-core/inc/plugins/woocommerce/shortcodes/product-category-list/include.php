<?php

include_once FIRSTFRAME_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-category-list/media-custom-fields.php';
include_once FIRSTFRAME_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-category-list/class-firstframecore-product-category-list-shortcode.php';

foreach ( glob( FIRSTFRAME_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-category-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
