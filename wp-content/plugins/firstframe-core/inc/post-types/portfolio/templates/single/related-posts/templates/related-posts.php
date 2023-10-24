<?php
$post_id       = get_the_ID();
$is_enabled    = firstframe_core_get_post_value_through_levels( 'qodef_portfolio_single_enable_related_posts' );
$related_posts = firstframe_core_get_custom_post_type_related_posts( $post_id, firstframe_core_get_portfolio_single_post_taxonomies( $post_id ) );

if ( 'yes' === $is_enabled && ! empty( $related_posts ) && class_exists( 'FirstFrameCore_Portfolio_List_Shortcode' ) ) { ?>
	<div id="qodef-portfolio-single-related-items">
	<h3 class="qodef-related-portfolio-title"><?php echo qode_framework_wp_kses_html( 'content', 'Similiar <mark>Movies</mark>' ) ?></h3>
		<?php
		$params = apply_filters(
			'firstframe_core_filter_portfolio_single_related_posts_params',
			array(
				'columns'           => '3',
				'posts_per_page'    => 3,
				'additional_params' => 'id',
				'post_ids'          => $related_posts['items'],
				'layout'            => 'info-on-hover',
				'title_tag'         => 'h5',
				'excerpt_length'    => '100',
			)
		);

		echo FirstFrameCore_Portfolio_List_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
