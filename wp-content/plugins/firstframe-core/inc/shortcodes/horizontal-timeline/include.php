<?php

include_once FIRSTFRAME_CORE_SHORTCODES_PATH . '/horizontal-timeline/horizontal-timeline.php';

foreach ( glob( FIRSTFRAME_CORE_SHORTCODES_PATH . '/horizontal-timeline/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
