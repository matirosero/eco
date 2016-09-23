<?php
/**
 * Template Name: Sidebar Left
 * The template for displaying a page with the sidebar on the left side.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */

get_header(); ?>

<div class="expanded row">

	<div class="medium-8 medium-push-4 large-9 large-push-3 xxlarge-10 xxlarge-push-2 columns">

		<div id="primary" class="content-area row">
			<main id="main" class="site-main large-9 large-centered xxlarge-7 columns" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'components/content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div>

	<div class="medium-4 medium-pull-8 large-3 large-pull-9 xxlarge-2 xxlarge-pull-10 columns">

		<?php get_sidebar(); ?>

	</div>

</div><!-- .row -->

<?php get_footer(); ?>
