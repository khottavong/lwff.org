<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-line"></div>
	<?php if ( is_array( $items ) && count( $items ) ) { ?>
		<div class="qodef-m-inner clearfix">
			<?php
			$position_class = '';

			foreach ( $items as $key => $item ) {

				if ( $key % 2 === 0 ) {
					$position_class = 'qodef-order--odd';
				} else {
					$position_class = 'qodef-order--even';
				}
				?>
				<div class="qodef-e-item qodef-e">
					<div class="qodef-e-content">
						<?php if ( ! empty( $item['date_range'] ) ) { ?>
							<h5 class="qodef-e-date-range"><?php echo wp_kses_post( $item['date_range'] ); ?></h5>
						<?php } ?>
						<?php if ( ! empty( $item['text'] ) ) { ?>
							<p class="qodef-e-text"><?php echo esc_html( $item['text'] ); ?></p>
						<?php } ?>
					</div>
					<div class="qodef-e-circle-holder">
						<div class="qodef-e-circle">
							<div class="qodef-e-circle-inner"></div>
						</div>

					</div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</div>
