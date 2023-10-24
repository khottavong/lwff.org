<?php if ( $query_result->have_posts() ) {
	while ( $query_result->have_posts() ) :
		$query_result->the_post();?>
		<div class="qodef-e swiper-slide">
			<?php firstframe_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/image', '', $params); ?>
		</div>
	<?php endwhile; // End of the loop.
}

wp_reset_postdata();
