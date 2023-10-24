<?php

if ( ! function_exists( 'firstframe_core_add_predefined_spinner_layout_option' ) ) {
    /**
     * Function that set new value into page spinner layout options map
     *
     * @param array $layouts - module layouts
     *
     * @return array
     */
    function firstframe_core_add_predefined_spinner_layout_option( $layouts ) {
        $layouts['predefined'] = esc_html__( 'Predefined', 'firstframe-core' );

        return $layouts;
    }

    add_filter( 'firstframe_core_filter_page_spinner_layout_options', 'firstframe_core_add_predefined_spinner_layout_option' );
}

if ( ! function_exists( 'firstframe_core_add_predefined_spinner_layout_classes' ) ) {
    /**
     * Function that return classes for page spinner area
     *
     * @param array $classes
     *
     * @return array
     */
    function firstframe_core_add_predefined_spinner_layout_classes( $classes ) {
        $type = firstframe_core_get_post_value_through_levels( 'qodef_page_spinner_type' );

        if ( 'predefined' === $type ) {
            $classes[] = 'qodef--custom-spinner';
        }

        return $classes;
    }

    add_filter( 'firstframe_core_filter_page_spinner_classes', 'firstframe_core_add_predefined_spinner_layout_classes' );
}

if ( ! function_exists( 'firstframe_core_set_predefined_spinner_layout_as_default_option' ) ) {
    /**
     * Function that set default value for page spinner layout options map
     *
     * @param string $default_value
     *
     * @return string
     */
    function firstframe_core_set_predefined_spinner_layout_as_default_option( $default_value ) {
        return 'predefined';
    }

    add_filter( 'firstframe_core_filter_page_spinner_default_layout_option', 'firstframe_core_set_predefined_spinner_layout_as_default_option' );
}
