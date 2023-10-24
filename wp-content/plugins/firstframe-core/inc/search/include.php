<?php

include_once FIRSTFRAME_CORE_INC_PATH . '/search/class-firstframecore-search.php';
include_once FIRSTFRAME_CORE_INC_PATH . '/search/helper.php';
include_once FIRSTFRAME_CORE_INC_PATH . '/search/dashboard/admin/search-options.php';

foreach ( glob( FIRSTFRAME_CORE_INC_PATH . '/search/layouts/*/include.php' ) as $layout ) {
	include_once $layout;
}
