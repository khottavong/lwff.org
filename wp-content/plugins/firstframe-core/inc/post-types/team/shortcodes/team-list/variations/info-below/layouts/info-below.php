<?php
$styles = array();
if ( ! empty( $info_below_content_margin_top ) ) {
	$margin_top = qode_framework_string_ends_with_space_units( $info_below_content_margin_top ) ? $info_below_content_margin_top : intval( $info_below_content_margin_top ) . 'px';
	$styles[]   = 'margin-top:' . $margin_top;
}
?>
<div <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-image">
			<?php firstframe_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/image', '', $params ); ?>
                  <div class="qodef-e-social-wrapper">
                <?php firstframe_core_list_sc_template_part('post-types/team/shortcodes/team-list', 'post-info/social-icons', '', $params); ?>
            </div>
		</div>
		<div class="qodef-e-content" <?php qode_framework_inline_style( $styles ); ?>>
			<?php firstframe_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/title', '', $params ); ?>
			<?php firstframe_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/role', '', $params ); ?>
			<?php firstframe_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/excerpt', '', $params ); ?>

		</div>
	</div>
</div>
