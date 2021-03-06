<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */

get_header(); ?>

<div class="expanded small-collapse row" data-equalizer data-equalize-on="medium" >

	<div class="medium-8 large-9 xxlarge-10 columns">

		<div id="primary" class="content-area row" data-equalizer-watch > 
			<main id="main" class="site-main large-centered large-10 xxlarge-8 columns" role="main">

				<?php if ( have_posts() ) : ?>

					<?php if ( is_author() ) : ?>

						<header class="page-header">
							<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="taxonomy-description">', '</div>' );
							?>
						</header><!-- .page-header -->


					<?php else: ?>

						<header class="page-header">
							<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="taxonomy-description">', '</div>' );
							?>
						</header><!-- .page-header -->

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

				<?php 
				if (function_exists("joints_page_navi")) :
				    // $wp_query = $more_posts;
				//echo '<div>$wp_query ='.$wp_query->max_num_pages.'</div>';
				    joints_page_navi();
				else:
					the_posts_navigation(); 
				endif; ?>

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
