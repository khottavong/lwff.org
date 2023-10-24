<?php
$portfolio_list_image = get_post_meta( get_the_ID(), 'qodef_portfolio_list_image', true );
$has_image            = ! empty( $portfolio_list_image ) || has_post_thumbnail();
$portfolio_list_video = get_post_meta( get_the_ID(), 'qodef_portfolio_list_video_url', true );
$portfolio_video_type = get_post_meta( get_the_ID(), 'qodef_portfolio_video_type', true );
$has_video            = ! empty( $portfolio_list_video );

if ( 'autoplay' === $portfolio_video_type ) {
	$media_class = 'qodef-video--autoplay';
} elseif ( 'hover' === $portfolio_video_type ) {
	$media_class = 'qodef-video--on-hover';
}

if ( ( 'autoplay' === $portfolio_video_type || 'hover' === $portfolio_video_type ) && $has_video && 'false' === $is_related ) {
	$portfolio_url = firstframe_core_get_portfolio_list_item_url( get_the_ID() );
	?>
	<div class="<?php echo esc_attr( $media_class ); ?>">
		<?php
		if ( $has_video && 'false' === $is_related && ! empty( $play_button ) && 'yes' === $play_button) {
			$unique_id = 'qodef-cicle-path-' . rand( 0, 1000 );
			?>
			<a href="<?php echo esc_url( $portfolio_list_video ); ?>" itemprop="url" class="qodef-m-play qodef-play-button qodef-magnific-popup qodef-popup-item" data-type="iframe">
				<svg class="qodef-circle-svg" xmlns="http://www.w3.org/2000/svg" width="144" height="144" viewBox="0 0 144 144">
					<path id="<?php echo esc_attr( $unique_id ) ?>" fill="none" d="M16,72a56,56,0,1,1,56,56A56,56,0,0,1,16,72" />
					<g class="qodef-circle-text-holder">
						<text class="qodef-circle-text">
							<textPath xlink:href="#<?php echo esc_attr( $unique_id ) ?>"><?php echo esc_attr__( 'PLAY ○ PLAY ○ PLAY ○ PLAY ○ PLAY ○ PLAY ○', 'firstframe-core' ) ?></textPath>
						</text>
					</g>
					<polygon class="qodef-play-stroke" points="60,49 94,72 60,95" style="fill:none;stroke:currentColor;stroke-width:1" />
					<polygon class="qodef-play-fill" points="60,49 94,72 60,95" style="fill:currentColor;stroke:currentColor;stroke-width:1" />
				</svg>
			</a>
			<?php
		}
		?>
		<a itemprop="url" href="<?php echo esc_url( $portfolio_url['link'] ); ?>" target="<?php echo esc_attr( $portfolio_url['target'] ); ?>">
			<?php if ( 'autoplay' === $portfolio_video_type ) { ?>
				<video autoplay="autoplay" loop="loop" muted="muted" playsinline>
					<source src="<?php echo esc_url( $portfolio_list_video ); ?>" type="video/mp4">
				</video>
			<?php } if ( 'hover' === $portfolio_video_type ) { ?>
				<video loop="loop" muted="muted" playsinline>
					<source src="<?php echo esc_url( $portfolio_list_video ); ?>" type="video/mp4">
				</video>
			<?php } ?>
		</a>
	</div>
	<?php
} elseif ( $has_image ) {
	$portfolio_url       = firstframe_core_get_portfolio_list_item_url( get_the_ID() );
	$image_dimension     = isset( $image_dimension ) && ! empty( $image_dimension ) ? esc_attr( $image_dimension['size'] ) : 'full';
	$custom_image_width  = isset( $custom_image_width ) && '' !== $custom_image_width ? intval( $custom_image_width ) : 0;
	$custom_image_height = isset( $custom_image_height ) && '' !== $custom_image_height ? intval( $custom_image_height ) : 0;
	?>
	<div class="qodef-e-media-image">
		<?php
		if ( $has_video && 'false' === $is_related && ! empty( $play_button ) && 'yes' === $play_button) {
			$unique_id = 'qodef-cicle-path-' . rand( 0, 1000 );
			?>
			<a href="<?php echo esc_url( $portfolio_list_video ); ?>" itemprop="url" class="qodef-m-play qodef-play-button qodef-magnific-popup qodef-popup-item" data-type="iframe">
				<svg class="qodef-circle-svg" xmlns="http://www.w3.org/2000/svg" width="144" height="144" viewBox="0 0 144 144">
					<path id="<?php echo esc_attr( $unique_id ) ?>" fill="none" d="M16,72a56,56,0,1,1,56,56A56,56,0,0,1,16,72" />
					<g class="qodef-circle-text-holder">
						<text class="qodef-circle-text">
							<textPath xlink:href="#<?php echo esc_attr( $unique_id ) ?>"><?php echo esc_attr__( 'PLAY ○ PLAY ○ PLAY ○ PLAY ○ PLAY ○ PLAY ○', 'firstframe-core' ) ?></textPath>
						</text>
					</g>
					<polygon class="qodef-play-stroke" points="60,49 94,72 60,95" style="fill:none;stroke:currentColor;stroke-width:1" />
					<polygon class="qodef-play-fill" points="60,49 94,72 60,95" style="fill:currentColor;stroke:currentColor;stroke-width:1" />
				</svg>
			</a>
			<?php
		}
		?>
		<?php if ( true === $is_related ) { ?>
			<a itemprop="url" href="<?php echo esc_url( $portfolio_url['link'] ); ?>" target="<?php echo esc_attr( $portfolio_url['target'] ); ?>">
				<?php echo firstframe_core_get_list_shortcode_item_image( $image_dimension, 0, $custom_image_width, $custom_image_height ); ?>
			</a>
		<?php } else { ?>
			<a itemprop="url" href="<?php echo esc_url( $portfolio_url['link'] ); ?>" target="<?php echo esc_attr( $portfolio_url['target'] ); ?>">
				<?php echo firstframe_core_get_list_shortcode_item_image( $image_dimension, $portfolio_list_image, $custom_image_width, $custom_image_height ); ?>
			</a>
		<?php } ?>
	</div>
<?php } ?>
