<?php

$params = array_merge( $params, firstframe_core_vertical_split_slider_generate_template_params( $item ) );

// include content title
firstframe_core_template_part( 'shortcodes/vertical-split-slider', 'templates/parts/title', '', $params );

// include content text
firstframe_core_template_part( 'shortcodes/vertical-split-slider', 'templates/parts/text', '', $params );

// include content button
firstframe_core_template_part( 'shortcodes/vertical-split-slider', 'templates/parts/button', '', $params );
