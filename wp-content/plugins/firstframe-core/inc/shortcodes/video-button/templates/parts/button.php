<?php if ( ! empty( $video_link ) ) {
	$unique_id = 'qodef-cicle-path-' . rand( 0, 1000 );
	?>
	<a itemprop="url" class="qodef-m-play qodef-magnific-popup qodef-popup-item" <?php echo qode_framework_get_inline_style( $play_button_styles ); ?> href="<?php echo esc_url( $video_link ); ?>" data-type="iframe">
		<div class="qodef-play-button">
			<svg class="qodef-circle-svg" xmlns="http://www.w3.org/2000/svg" width="144" height="144" viewBox="0 0 144 144">
				<path id="<?php echo esc_attr( $unique_id ) ?>" fill="none" d="M16,72a56,56,0,1,1,56,56A56,56,0,0,1,16,72" />
				<text class="qodef-circle-text">
					<textPath xlink:href="#<?php echo esc_attr( $unique_id ) ?>"><?php echo esc_attr__( 'PLAY ○ PLAY ○ PLAY ○ PLAY ○ PLAY ○ PLAY ○', 'firstframe-core' ) ?></textPath>
				</text>
				<polygon class="qodef-play-stroke" points="60,49 94,72 60,95" style="fill:none;stroke:currentColor;stroke-width:1" />
				<polygon class="qodef-play-fill" points="60,49 94,72 60,95" style="fill:currentColor;stroke:currentColor;stroke-width:1" />
			</svg>
		</div>
	</a>
<?php } ?>
