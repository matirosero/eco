<?php
/**
 * Template part for displaying testimonials.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */
?>

<?php

/**
 * The WordPress Query class.
 * @link http://codex.wordpress.org/Function_Reference/WP_Query
 *
 */
$args = array(

	//Type & Status Parameters
	'post_type'   => 'testimonial',
	'post_status' => 'publish',

	//Order & Orderby Parameters
	'order'               => 'DESC',
	'orderby'             => 'date',

	//Pagination Parameters
	'posts_per_page'         => -1,

	//Permission Parameters -
	'perm' => 'readable',

	//Parameters relating to caching
	'no_found_rows'          => false,
	'cache_results'          => true,
	'update_post_term_cache' => true,
	'update_post_meta_cache' => true,

);

$query = new WP_Query( $args );

while ( $query->have_posts() ) : $query->the_post(); ?>

	<article class="">
		<?php the_content(); ?>
		<?php the_title(); ?>
	</article>

<?php endwhile;
wp_reset_postdata();
?>