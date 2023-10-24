<?php
$quote_meta = get_post_meta( get_the_ID(), 'qodef_post_format_quote_text', true );
$quote_text = ! empty( $quote_meta ) ? $quote_meta : get_the_title();

if ( ! empty( $quote_text ) ) {
	$title_tag        = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h5';
	?>
	<div class="qodef-e-quote">
	<span class="qodef-e-quote-icon"></span>
		<?php            // Include post category info
			firstframe_template_part('blog', 'templates/parts/post-info/date'); ?>
		<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-quote-text"><?php echo esc_html( $quote_text ); ?></<?php echo esc_attr( $title_tag ); ?>>

		<?php if ( ! is_single() ) { ?>
			<a itemprop="url" class="qodef-e-quote-url" href="<?php the_permalink(); ?>"></a>
		<?php } ?>
	</div>
<?php } ?>
