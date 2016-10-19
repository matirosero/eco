<?php
/**
 * Add Categories/Tags to [downloads] shortcode
 */

$download_categories = get_the_term_list( // get the download categories
	$post->ID,
	'download_category',
	'<span class="download-categories-title"></span>',
	', ',
	''
);
// $download_tags = get_the_term_list( // get the download tags
// 	$post->ID,
// 	'download_tag',
// 	'<span class="download-categories-title"></span>',
// 	', ',
// 	''
// );

if ( $download_categories || $download_tags ) {
	?>
	<div class="shop-download-terms">
		<?php echo $download_categories ?>
	</div>
	<?php /*
	<div class="shop-download-terms">
		<?php echo $download_tags ?>
	</div>
	*/ ?>
	<?php
}
