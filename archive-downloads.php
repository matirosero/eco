<?php
/**
 * Template Name: Full Width (no sidebar)
 * The template for displaying a full width page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */

get_header(); ?>




<?php //get_template_part( 'components/content', 'hero' ); ?>

<div class="row column">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="page-header">
				<h1 class="page-title"><em>Tienda</em> ECO</h1>
			</header>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'components/content', 'downloads' ); ?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div><!-- .row -->

<?php get_footer(); ?>
