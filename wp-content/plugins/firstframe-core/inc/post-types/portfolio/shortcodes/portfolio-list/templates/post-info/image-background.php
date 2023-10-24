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
	$image_dimension = isset( $image_dimension ) && ! empty( $image_dimension ) && 'custom' !== $image_dimension ? esc_attr( $image_dimension['size'] ) : 'full';
	$image_url       = firstframe_core_get_list_shortcode_item_image_url( $image_dimension, $portfolio_list_image );
	$style           = ! empty( $image_url ) ? 'background-image: url( ' . esc_url( $image_url ) . ')' : '';
	?>
	<div class="qodef-e-media-image qodef--background" <?php qode_framework_inline_style( $style ); ?>></div>
<?php } ?>
