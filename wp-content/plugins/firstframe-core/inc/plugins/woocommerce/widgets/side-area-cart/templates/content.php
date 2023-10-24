<?php if ( is_object( WC()->cart ) ) { ?>
	<div class="qodef-widget-side-area-cart-content">
		<?php
		// Hook to include additional content before cart items
		do_action( 'firstframe_core_action_woocommerce_before_side_area_cart_content' );

		if ( ! WC()->cart->is_empty() ) {
			firstframe_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/loop' );

			firstframe_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/order-details' );

			firstframe_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/button' );
		} else {
			// Include posts not found
			firstframe_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/posts-not-found' );
		}

		firstframe_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/close' );
		?>
	</div>
<?php } ?>
