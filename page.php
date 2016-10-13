<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */

get_header(); ?>

<?php get_template_part( 'components/content', 'hero' ); ?>

<div class="expanded small-collapse row" data-equalizer data-equalize-on="medium" >

	<div class="medium-8 large-9 xxlarge-10 columns">

		<div id="primary" class="content-area row" data-equalizer-watch >
			<main id="main" class="site-main large-9 large-centered xxlarge-7 columns" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php 

					if ( is_page('Sobre nosotras') || is_page('Sobre ECO') ) :
						get_template_part( 'components/content', 'about' ); 
					else:
						get_template_part( 'components/content', 'page' ); 
					endif;
					?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns -->

	<div class="medium-4 large-3 xxlarge-2 columns full-height">

		<?php get_sidebar(); ?>

	</div><!-- .columns -->

</div><!-- .row -->

<?php get_footer(); ?>
