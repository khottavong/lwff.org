<?php
$styles = array();
if ( ! empty( $info_below_content_margin_top ) ) {
	$margin_top = qode_framework_string_ends_with_space_units( $info_below_content_margin_top ) ? $info_below_content_margin_top : intval( $info_below_content_margin_top ) . 'px';
	$styles[]   = 'margin-top:' . $margin_top;
}
?>
<div <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-content" <?php qode_framework_inline_style( $styles ); ?>>
			<?php firstframe_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/rating', '', $params ); ?>
			<?php firstframe_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/title', '', $params ); ?>
			<?php firstframe_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/text', '', $params ); ?>
		</div>
		<div class="qodef-e-content-bottom">
			<?php firstframe_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/image', '', $params ); ?>
			<?php firstframe_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/author', '', $params ); ?>
		</div>
	</div>
</div>
