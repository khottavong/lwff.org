<div class="qodef-reviews-list-info qodef-reviews-per-mark">
	<?php foreach ( $post_ratings as $rating ) { ?>
		<?php
		$average_rating     = firstframe_core_post_average_rating( $rating );
		$rating_count       = $rating['count'];
		$rating_count_label = 1 === $rating_count ? esc_html__( 'Rating', 'firstframe-core' ) : esc_html__( 'Ratings', 'firstframe-core' );
		$rating_marks       = $rating['marks'];
		?>
		<div class="qodef-reviews-number-holder">
			<div class="qodef-reviews-number-wrapper">
				<span class="qodef-reviews-number"><?php echo esc_html( $average_rating ); ?></span>
				<span class="qodef-stars-wrapper">
							<span class="qodef-stars">
								<?php for ( $i = 1; $i <= $average_rating; $i ++ ) {
									echo firstframe_core_get_svg_icon( 'star' );
								} ?>
							</span>
							<span class="qodef-reviews-count">
								<?php echo esc_html__( 'Rated', 'firstframe-core' ) . ' ' . $average_rating . ' ' . esc_html__( 'out of', 'firstframe-core' ) . ' ' . $rating_count . ' ' . $rating_count_label; ?>
							</span>
						</span>
			</div>
			<div class="qodef-rating-percentage-wrapper">
				<?php
				foreach ( $rating_marks as $item => $value ) {
					$percentage = 0 == $rating_count ? 0 : round( ( $value / $rating_count ) * 100 );
					echo do_shortcode( '[firstframe_core_progress_bar layout="line" number="' . esc_attr( $percentage ) . '" title="' . esc_attr( $item ) . esc_attr__( ' stars', 'firstframe-core' ) . '"]' );
				}
				?>
			</div>
		</div>
	<?php } ?>
</div>
