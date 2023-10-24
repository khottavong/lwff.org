<div class="qodef-divided-header-left-wrapper">
	<?php
	// Include widget area two
	firstframe_core_get_header_widget_area( 'two' );

	// Include divided left navigation
	firstframe_core_template_part( 'header/layouts/divided', 'templates/parts/left-navigation' );
	?>
</div>
<?php
// Include logo
firstframe_core_get_header_logo_image();
?>
<div class="qodef-divided-header-right-wrapper">
	<?php
	// Include divided right navigation
	firstframe_core_template_part( 'header/layouts/divided', 'templates/parts/right-navigation' );

	// Include widget area one
	firstframe_core_get_header_widget_area();
	?>
</div>
