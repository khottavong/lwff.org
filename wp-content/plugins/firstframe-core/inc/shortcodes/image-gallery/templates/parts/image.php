<div class="<?php echo esc_attr( $item_classes ); ?>">
	<span class='qodef-e-image'>
	<?php if ( 'open-popup' === $image_action || 'open-video-popup' === $image_action ) { ?>
		<a class="qodef-popup-item" itemprop="image" href="<?php echo esc_url( $url ); ?>" data-type="<?php echo esc_attr( $data_type ); ?>" title="<?php echo esc_attr( $alt ); ?>">
	<?php } elseif ( 'custom-link' === $image_action && ! empty( $url ) ) { ?>
		<a itemprop="url" href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php } ?>
			<?php
			if ( 'open-video-popup' === $image_action ) {
				$unique_id = 'qodef-cicle-path-' . rand( 0, 1000 );
				?>
				<span class="qodef-play-button">
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
				</span>
				<?php
			}
			?>
		<?php
		if ( is_array( $image_size ) && count( $image_size ) ) {
			echo qode_framework_generate_thumbnail( $image_id, $image_size[0], $image_size[1] );
		} else {
			echo wp_get_attachment_image( $image_id, $image_size );
		}
		?>
	<?php if ( ( 'open-popup' === $image_action || 'open-video-popup' === $image_action ) || ( 'custom-link' === $image_action && ! empty( $url ) ) ) { ?>
		</a>
	<?php } ?>
	</span>
</div>
