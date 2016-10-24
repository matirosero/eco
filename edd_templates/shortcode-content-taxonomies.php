<?php
/**
 * Add Categories/Tags to [downloads] shortcode
 */

$terms = wp_get_object_terms( $post->ID, 'download_category' );

foreach( $terms as $term )
    $term_names[] = '<span class="download-categories-title">'.$term->name.'</span>';

$download_categories = implode( ', ', $term_names );


if ( $download_categories ) {
	?>
	<div class="shop-download-terms">
		<?php echo $download_categories ?>
	</div>
	<?php
}
