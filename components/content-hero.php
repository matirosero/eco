<?php
// If a feature image is set, get the id, so it can be injected as a css background property
if ( has_post_thumbnail( $post->ID ) ) :
	$default_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	$default_image = $default_image[0];

	$small_image = get_field('thumbnail_small');
	$medium_image = get_field('thumbnail_medium');
	$large_image = get_field('thumbnail_large');
	$xlarge_image = get_field('thumbnail_xlarge');

	if ( empty( $xlarge_image ) && empty( $large_image ) && empty( $medium_image ) && empty( $small_image ) ) : ?>

		<header id="featured-hero" role="banner" style="background-image: url('<?php echo $default_image ?>')">

	<?php else:

		//default image (xxxl) is the fallback
		$mq = '#featured-hero {
						background-image: url('.$default_image.')
				}';

		if ( !empty( $xlarge_image ) ) :
			$mq .= '@media only screen and (max-width : 1440px) {
					#featured-hero {
						background-image: url('.$xlarge_image.')
					}
				}';
		endif;

		if ( !empty( $large_image ) ) :
			$mq .= '@media only screen and (max-width : 1200px) {
				#featured-hero {
					background-image: url('.$large_image.')
				}
			}';
		endif;

		if ( !empty( $medium_image ) ) :
			$mq .= '@media only screen and (max-width : 1024px) {
				#featured-hero {
					background-image: url('.$medium_image.')
				}
			}';
		endif;

		if ( !empty( $small_image ) ) :
			$mq .= '@media only screen and (max-width : 640px) {
				#featured-hero {
					background-image: url('.$small_image.')
				}
			}';
		endif;
		?>

		<header id="featured-hero" role="banner">
			<style scoped>
				<?php echo $mq; ?>
			</style>
	<?php endif;
	?>

	<!-- <header id="featured-hero" role="banner" style="background-image: url('<?php echo $default_image ?>')"> -->

		<?php if ( is_front_page() ) : ?>

			<div class="hero-text">
				<h1 class="page-title"><?php the_field( 'page_subtitle' ); ?></h1>
				<div class="hero-signup hide-for-small-only">
					<?php
					if( function_exists( 'mc4wp_show_form' ) ) {
					    echo '<p>'.get_field( 'home_hero_form_text').'</p>';
					    mc4wp_show_form();
					}
					?>
				</div>
			</div>

		<?php elseif ( is_page() ) : ?>
			<!-- <div class="row"> -->
				<!-- <div class="medium-5 medium-offset-1 columns"> -->
					<div class="hero-text">
						<?php
						if ( is_page('Sobre nosotras') || is_page('Sobre ECO') ) :
							echo '<h1 class="page-title"><em>Sobre</em> nosotras</h1>';
						else:
							the_title( '<h1 class="page-title">', '</h1>' );
						endif; ?>
						<p class="page-subtitle"><?php the_field( 'page_subtitle' ); ?></p>
					</div>
				<!-- </div> --><!-- .columns -->
			<!-- </div> --><!-- .row -->
		<?php endif; ?>

	</header><!-- #featured-hero -->

<?php endif;
