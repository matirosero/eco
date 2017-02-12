<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Eco
 */

get_header(); ?>

<?php get_template_part( 'components/content', 'hero' ); ?>

<div class="expanded small-collapse row" data-equalizer data-equalize-on="medium" >

	<div class="medium-8 large-9 xxlarge-9 columns">

		<div id="primary" class="content-area row" data-equalizer-watch >
			<main id="main" class="site-main large-centered large-10 xxlarge-8 columns" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'components/content', 'service' ); ?>

			<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns  -->

	<div class="medium-4 large-3 xxlarge-3 columns full-height">

		<?php get_sidebar(); ?>

	</div><!-- .columns -->

</div><!-- .row -->

<?php get_footer(); ?>
