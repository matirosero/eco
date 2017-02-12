<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

		<?php
		echo do_shortcode('[contact-form-7 id="368" title="Reserva"]'); 
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php eco_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
