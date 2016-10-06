<?php
// If a feature image is set, get the id, so it can be injected as a css background property
if ( has_post_thumbnail( $post->ID ) ) :
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	$image = $image[0];
	?>

	<header id="featured-hero" role="banner" style="background-image: url('<?php echo $image ?>')">

		<?php if ( is_front_page() ) : ?>

			<div class="hero-text">
				<h1 class="page-title"><?php the_field( 'page_subtitle' ); ?></h1>
				<?php
				if( function_exists( 'mc4wp_show_form' ) ) {
				    echo '<p>'.get_field( 'home_hero_form_text').'</p>';
				    mc4wp_show_form();
				}
				?>
			</div>

		<?php elseif ( is_page() ) : ?>
			<!-- <div class="row"> -->
				<!-- <div class="medium-5 medium-offset-1 columns"> -->
					<div class="hero-text">
						<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
					</div>
				<!-- </div> --><!-- .columns -->
			<!-- </div> --><!-- .row -->
		<?php endif; ?>

	</header><!-- #featured-hero -->

<?php endif;
