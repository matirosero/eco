<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */

get_header(); ?>

<div class="expanded small-collapse row" data-equalizer data-equalize-on="medium" >

	<div class="medium-8 large-9 xxlarge-10 columns">

		<div id="primary" class="content-area row"  data-equalizer-watch> 
			<main id="main" class="site-main large-9 large-centered xxlarge-7 columns" role="main">

			<?php if ( have_posts() ) : ?>


				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header class="page-header">
						<h1 class="page-title"><em>Blog</em> ECO</h1>
					</header>
				<?php endif; ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'components/content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'components/content', 'none' ); ?>

			<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns  -->

	<div class="medium-4 large-3 xxlarge-2 columns full-height">

		<?php get_sidebar(); ?>

	</div><!-- .columns -->

</div><!-- .row -->

<?php get_footer(); ?>
