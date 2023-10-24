<?php

if ( ! function_exists( 'firstframe_core_filter_clients_list_image_only_no_hover' ) ) {
    /**
     * Function that add variation layout for this module
     *
     * @param array $variations
     *
     * @return array
     */
    function firstframe_core_filter_clients_list_image_only_no_hover( $variations ) {
        $variations['no-hover'] = esc_html__( 'No Hover', 'firstframe-core' );

        return $variations;
    }

    add_filter( 'firstframe_core_filter_clients_list_image_only_animation_options', 'firstframe_core_filter_clients_list_image_only_no_hover' );
}