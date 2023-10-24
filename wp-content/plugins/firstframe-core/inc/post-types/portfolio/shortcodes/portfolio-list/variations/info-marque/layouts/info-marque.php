<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner" <?php qode_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ); ?>>
		<?php firstframe_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/image', 'background', $params ); ?>
		<div class="qodef-e-top-wrapper">
			<div class="qodef-e-top-holder">
				<div class="qodef-e-info">
					<?php
					// Include post category info
					firstframe_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/categories', '', $params );

					firstframe_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/video-meta', '', $params );
					?>
				</div>
			</div>
			<div class="qodef-e-content">
				<?php
				$portfolio_url = firstframe_core_get_portfolio_list_item_url( get_the_ID() );
				?>
				<a itemprop="url" class="qodef-e-post-link" href="<?php echo esc_url( $portfolio_url['link'] ); ?>" target="<?php echo esc_attr( $portfolio_url['target'] ); ?>">
					<div class="qodef-e-text">
						<?php
						$title                = get_the_title();
						$title_marquee_params = array(

							'text_1'    => $title,
							'text_2'    => $title,
							'text_3'    => $title,
							'skin'      => 'yes',

						);
						echo FirstFrameCore_Text_Marquee_Shortcode::call_shortcode( $title_marquee_params ); ?>
					</div>
				</a>
			</div>
		</div>
		<?php firstframe_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/link' ); ?>
	</div>
</article>