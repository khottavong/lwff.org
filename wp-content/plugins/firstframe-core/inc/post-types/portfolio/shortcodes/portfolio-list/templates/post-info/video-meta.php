<?php
$portfolio_list_video_url = get_post_meta( get_the_ID(), 'qodef_portfolio_list_video_url', true );

if ( ! empty( $portfolio_list_video_url ) ) {
	$video_meta = get_post_meta( attachment_url_to_postid($portfolio_list_video_url), '_wp_attachment_metadata', true );

	if ( isset( $video_meta['length_formatted'] ) && ! empty( $video_meta['length_formatted'] ) ) {
		echo '<span>' . esc_attr( $video_meta['length_formatted'] ) . '</span>'; ?>
		<div class="qodef-info-separator-end"></div>
	<?php }?>
<?php } ?>
