<li <?php wc_product_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="qodef-e-media">
				<?php firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/image', '', $params ); ?>
			</div>
		<?php } ?>
		<div class="qodef-e-media-inner">
			<div class="qodef-e-top-holder">
				<div class="qodef-e-info">
					<?php
					// Include post category info
					firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/categories', '', $params );
					?>
				</div>
			</div>
			<?php firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/title', '', $params ); ?>
			<?php firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/rating', '', $params ); ?>
			<?php firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/price', '', $params ); ?>
			<?php firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/add-to-cart' ); ?>
			<?php
			// Hook to include additional content inside product list item image
			do_action( 'firstframe_core_action_product_list_item_additional_hover_content' );

			// Hook to include additional content inside product list item content
			do_action( 'firstframe_core_action_product_list_item_additional_content' );
			?>
		</div>
		<?php firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/link' ); ?>
	</div>
</li>
