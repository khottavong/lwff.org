<div <?php qode_framework_class_attribute( $holder_classes ); ?> data-distance="<?php echo esc_attr( $distance ); ?>">

	<div class="qodef-ht-nav">
		<div class="qodef-ht-nav-wrapper">
			<div class="qodef-ht-nav-inner">
				<ol>
					<?php foreach ( $items as $key => $item ) {
						$dateLabel = date( $timeline_format, strtotime( $item['item_date'] ) );
						?>
						<li>
							<a href="#"
							   data-date="<?php echo esc_attr( $item['item_date'] ); ?>"><?php echo esc_html( $dateLabel ); ?></a>
						</li>
					<?php } ?>
				</ol>
				<span class="qodef-ht-nav-filling-line" aria-hidden="true"></span>
			</div>
		</div>

	</div>
	<div class="qodef-ht-content">
		<ol>
			<?php foreach ( $items as $key => $item ) : ?>
				<li data-date="<?php echo esc_attr( $item['item_date'] ) ?>">
					<div class="qodef-m-content-inner <?php echo esc_attr( $this_object->getItemClasses( $item ) ); ?>">
						<?php if ( ! empty( $item['item_image'] ) ): ?>
							<div class="qodef-hti-content-image">
								<?php echo wp_get_attachment_image( $item['item_image'], 'full' ); ?>
							</div>
						<?php endif; ?>
						<div class="qodef-m-content">
							<?php if ( ! empty( $item['item_title'] ) ): ?>
								<h2 class="qodef-m-title">
									<?php echo qode_framework_wp_kses_html( 'content', $item['item_title'] ); ?>
								</h2>
							<?php endif; ?>
							<?php if ( ! empty( $item['item_text'] ) ): ?>
								<div class="qodef-m-text">
									<?php echo qode_framework_wp_kses_html( 'content', $item['item_text'] ); ?>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $item['item_image_second'] ) ): ?>
							<div class="qodef-hti-content-image-second">
								<?php echo wp_get_attachment_image( $item['item_image_second'], 'full' ); ?>
							</div>
						<?php endif; ?>

						</div>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</div>
