<?php if ( is_active_sidebar( firstframe_get_sidebar_name() ) ) { ?>
	<aside id="qodef-page-sidebar" role="complementary">
		<?php dynamic_sidebar( firstframe_get_sidebar_name() ); ?>
	</aside>
<?php } ?>
