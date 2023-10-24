<?php

include_once FIRSTFRAME_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( FIRSTFRAME_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
