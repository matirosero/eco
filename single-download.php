<?php
/**
 * Template file for Downloads
 * Full width page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */

get_header(); ?>

<?php
if ( has_post_thumbnail( $post->ID ) ) :
	$default_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'eco-small' );
	$default_image = $default_image[0];
endif; ?>

<header id="product-header" class="expanded row collapse" role="banner" data-equalizer data-equalize-on="medium" >
	<div id="" class="product-image medium-4 columns" style="background-image: url('<?php echo $default_image ?>')" data-equalizer-watch >

	</div>
	<div class="medium-8 columns" data-equalizer-watch >
		<div class="product-header-container">
			<?php
			the_title( '<h1 class="page-title">', '</h1>' );
			?>
			<p class="page-subtitle"><?php the_field( 'downloads_subtitle' ); ?></p>

			<p class="product-intro"><?php the_field('downloads_intro'); ?></p>

			<?php if(function_exists('edd_price')) { ?>
				<div class="product-buttons">
					<?php if(!edd_has_variable_prices(get_the_ID())) { ?>
						<?php echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button'); ?>
					<?php } ?>

				</div><!--end .product-buttons-->
			<?php } ?>
		</div>
	</div>
</header><!-- #product-header -->

<div class="row">
	<div id="primary" class="content-area">
		<main id="main" class="site-main medium-10 large-10 medium-centered columns" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'components/content', 'download' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					// if ( comments_open() || get_comments_number() ) :
					// 	comments_template();
					// endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div><!-- .row -->

<?php get_footer(); ?>
