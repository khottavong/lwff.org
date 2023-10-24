<?php
$rating         = 5;
$current_rating = get_post_meta( get_the_ID(), 'qodef_testimonials_rating', true );
?>

<div class="qodef-rating-holder">
	<span class="qodef-rating-one">
	<?php
	for ( $i = 1; $i <= 5; $i ++ ) {
		if ( $i <= $current_rating ) { ?>
			<span class="qodef-e-current-rating">
				<?php echo firstframe_get_svg_icon( 'star' ); ?>
			</span>
		<?php } ?>
	<?php } ?>
	</span>
	<span class="qodef-rating-two">
		<?php
		for ( $i = 1; $i <= 5; $i ++ ) { ?>
			<span class="qodef-e-rating">
				<?php echo firstframe_get_svg_icon( 'star' ); ?>
			</span>
		<?php } ?>
	</span>


</div>
