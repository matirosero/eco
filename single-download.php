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
	<div id="" class="product-image large-4 columns" style="background-image: url('<?php echo $default_image ?>')" data-equalizer-watch >

	</div>
	<div class="large-8 columns" data-equalizer-watch >
		<div class="product-header-container row">



			<div class="product-header-info medium-8 columns">
				<?php
				the_title( '<h1 class="page-title">', '</h1>' );
				?>
				<p class="page-subtitle"><?php the_field( 'downloads_subtitle' ); ?></p>
				<p class="product-intro"><?php the_field('downloads_intro'); ?></p>
			</div><!--end .product-header-info-->
			<div class="medium-4 columns">
				<?php
				$buyboxclass = "buy-box";
				if ( get_field('downloads_dicount_price') ):
					$buyboxclass .= " has-discount";
				endif;
				?>
				<div class="<?php echo $buyboxclass; ?>">
					<?php if(function_exists('edd_price')) { ?>
						<?php if(!edd_has_variable_prices(get_the_ID())) {
							echo '<p class="buy-box-title">Precio</p>';
							edd_get_template_part( 'shortcode', 'content-price' );

							if ( get_field('downloads_dicount_price') ):

								echo '<span class="discount-price">';
								the_field('downloads_dicount_price');
								echo '</span>';
								echo '<p class="buy-box-notes">'.get_field('downloads_buybox_text').'</p>';
							endif;

							echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button');
							?>
						<?php } ?>
					<?php } ?>
				</div><!--end .buy-box-->
			</div><!--end .columns-->





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
