<?php
/**
 * The front-page.php template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */

get_header(); ?>

<div class="row">

	<div class="medium-8 columns">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

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

	</div><!-- .columns -->

	<div class="medium-4 columns">

		<?php get_sidebar(); ?>

	</div><!-- .columns -->

</div><!-- .row -->

<?php get_footer(); ?>
