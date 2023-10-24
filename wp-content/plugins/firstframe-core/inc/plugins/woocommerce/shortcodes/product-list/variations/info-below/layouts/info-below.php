<?php
$enable_product_category = firstframe_get_post_value_through_levels( 'qodef_woo_enable_product_category' );
$enable_product_rating   = firstframe_get_post_value_through_levels( 'qodef_woo_enable_product_rating' );
?>
<li <?php wc_product_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="qodef-e-media">
				<?php firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/image', '', $params ); ?>
				<div class="qodef-e-media-inner">
					<?php
					firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/add-to-cart' );

					// Hook to include additional content inside product list item image
					do_action( 'firstframe_core_action_product_list_item_additional_hover_content' );
					?>
				</div>
				<?php firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/link' ); ?>
			</div>
		<?php } ?>
		<div class="qodef-e-content">
			<div class="qodef-e-top-holder">
				<div class="qodef-e-info">
					<?php if ( $enable_product_category === 'yes' ) {
						// Include post category info
						firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/categories', '', $params );
					}
					?>
				</div>
			</div>
			<?php firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/title', '', $params ); ?>
			<?php if ( $enable_product_rating === 'yes' ) {
				// Include post rating info
				firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/rating', '', $params );
			}
			?>
			<?php firstframe_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/price', '', $params ); ?>
			<?php
			// Hook to include additional content inside product list item content
			do_action( 'firstframe_core_action_product_list_item_additional_content' );
			?>
		</div>
	</div>
</li>

