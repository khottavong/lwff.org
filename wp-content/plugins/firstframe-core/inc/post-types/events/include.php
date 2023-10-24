<?php

include_once FIRSTFRAME_CORE_CPT_PATH . '/events/helper.php';

foreach ( glob( FIRSTFRAME_CORE_CPT_PATH . '/events/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
