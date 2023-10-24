<div class="qodef-e-media">
	<?php
	switch ( get_post_format() ) {
		case 'gallery':
			firstframe_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			firstframe_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			firstframe_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			firstframe_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	}
	?>
</div>
