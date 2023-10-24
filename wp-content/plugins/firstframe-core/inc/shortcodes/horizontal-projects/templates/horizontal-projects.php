<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-hl-items-wrapper">
		<?php if ( ! empty( $items ) ) : foreach ( $items as $item ) : ?>
			<div class="qodef-hl-item">
				<div class="qodef-hli-grid">
					<div class="qodef-hli-top">

						<?php if ( ! empty( $item['item_label_first'] ) ) { ?>
							<span class="qodef-hli-label-first">
                            <span><?php echo esc_html( $item['item_label_first'] ); ?></span>
								<?php if ( ! empty( $item['item_label_second'] ) ) { ?>
									<span class="qodef-hli-label-second">
                            <span><?php echo esc_html( $item['item_label_second'] ); ?></span>
                        </span>
								<?php } ?>
                        </span>
						<?php } ?>
					</div>
					<div class="qodef-hli-mid">

						<p class="qodef-hli-category">
							<?php if ( isset( $item['item_category_link'] ) && ! empty( $item['item_category_link'] ) ) { ?>
							<a href="<?php echo esc_url( $item['item_category_link'] ) ?>" target="_blank">
								<?php } ?>
								<?php echo esc_html( $item['item_category'] ); ?>
								<?php if ( isset( $item['item_category_link'] ) && ! empty( $item['item_category_link'] ) ) { ?>
							</a>
						<?php } ?>
						</p>
						<h5 class="qodef-hli-title">
							<?php if ( ! empty( $item['item_link'] ) ) { ?> <a
									href="<?php echo esc_url( $item['item_link'] ); ?>"
									target="<?php echo esc_attr( $item['item_target'] ); ?>"> <?php } ?>
								<?php echo esc_html( $item['item_title'] ); ?>
								<?php if ( ! empty( $item['item_link'] ) ) { ?> </a> <?php } ?>
						</h5>
					</div>
					<div class="qodef-hli-btm">
						<div class="qodef-hli-btm-inner">
							<?php if ( ! empty( $item['item_link'] ) ) { ?> <a
									href="<?php echo esc_url( $item['item_link'] ); ?>"
									target="<?php echo esc_attr( $item['item_target'] ); ?>"> <?php } ?>
								<div class="qodef-hli-btm-item qodef-hli-image">
									<?php
									$image_url = wp_get_attachment_image_src( $item['item_image'], 'full' )[0];
									$item_alt  = get_post_meta( $item['item_image'], '_wp_attachment_image_alt', true );
									?>
									<img src="<?php echo esc_url( $image_url ); ?>"
									     alt="<?php echo esc_attr( $item_alt ); ?>"/>
								</div>
								<?php if ( ! empty( $item['item_link'] ) ) { ?> </a> <?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; endif; ?>
		<div class="qodef-hl-cta">
			<h3 class="qodef-hl-cta-title"><?php echo qode_framework_wp_kses_html( 'content', $cta_title ); ?></h3>
			<?php if ( ! empty( $cta_widget_area ) && is_active_sidebar( $cta_widget_area ) ) : ?>
				<div class="qodef-hl-cta-widget">
					<?php dynamic_sidebar( $cta_widget_area ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div id="qodef-hl-scroll-area"></div>
</div>