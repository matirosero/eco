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

	<div class="medium-8 large-9 xxlarge-10 columns">

		<div id="primary" class="content-area row" data-equalizer-watch >
			<main id="main" class="site-main large-centered large-10 xxlarge-8 columns" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'components/content', 'single' ); ?>

				<?php the_post_navigation(
					array(
			            'prev_text'                  => __( '<i class="fa fa-arrow-left" aria-hidden="true"></i> %title' ),
			            'next_text'                  => __( '%title <i class="fa fa-arrow-right" aria-hidden="true"></i>' ),
			            // 'in_same_term'               => true,
			            // 'taxonomy'                   => __( 'post_tag' ),
			            // 'screen_reader_text' => __( 'Continue Reading' ),
        			)
        		); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns  -->

	<div class="medium-4 large-3 xxlarge-2 columns full-height">

		<?php get_sidebar(); ?>

	</div><!-- .columns -->

</div><!-- .row -->

<?php get_footer(); ?>
