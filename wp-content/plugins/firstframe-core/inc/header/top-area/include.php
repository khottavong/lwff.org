<?php

include_once FIRSTFRAME_CORE_INC_PATH . '/header/top-area/class-firstframecore-top-area.php';
include_once FIRSTFRAME_CORE_INC_PATH . '/header/top-area/helper.php';

foreach ( glob( FIRSTFRAME_CORE_INC_PATH . '/header/top-area/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}
