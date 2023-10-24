<?php
$tags = get_the_tags();

if ( $tags ) {
	the_tags( '', '' ); ?>

<?php } ?>
