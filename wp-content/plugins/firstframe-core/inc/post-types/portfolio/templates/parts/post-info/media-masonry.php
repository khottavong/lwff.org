<?php
$portfolio_media = get_post_meta( get_the_ID(), 'qodef_portfolio_media', true );

$masonry_classes   = '';
$number_of_columns = firstframe_core_get_post_value_through_levels( 'qodef_portfolio_columns_number' );
$masonry_classes  .= ! empty( $number_of_columns ) ? ' qodef-col-num--' . $number_of_columns : ' qodef-col-num--3';

$space_between_items = firstframe_core_get_post_value_through_levels( 'qodef_portfolio_space_between_items' );
$masonry_classes    .= ! empty( $space_between_items ) ? ' qodef-gutter--' . $space_between_items : ' qodef-gutter--tiny';

$vertical_space_between_items = firstframe_core_get_post_value_through_levels( 'qodef_portfolio_vertical_space_between_items' );
$masonry_classes             .= ! empty( $vertical_space_between_items ) ? ' qodef-vertical-gutter--' . $vertical_space_between_items : ' qodef-vertical-gutter--tiny';

if ( ! empty( $portfolio_media ) ) { ?>
	<div class="qodef-e qodef-grid qodef-layout--masonry qodef-items--fixed qodef-responsive--predefined <?php echo esc_attr( $masonry_classes ); ?>">
		<div class="qodef-grid-inner qodef-magnific-popup qodef-popup-gallery">
			<?php
			// Include global masonry template from theme
			firstframe_core_theme_template_part( 'masonry', 'templates/sizer-gutter', '', 'masonry' );

			foreach ( $portfolio_media as $media ) {
				$type       = $media['qodef_portfolio_media_type'];
				$media_name = 'qodef_portfolio_' . $type;

				$params          = array();
				$params['media'] = $media[ $media_name ];

				firstframe_core_template_part( 'post-types/portfolio', 'templates/parts/media/media', $type . '-masonry', $params );
			}
			?>
		</div>
	</div>
<?php } ?>
