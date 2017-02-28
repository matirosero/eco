<?php
/**
 * The front-page.php template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */

get_header(); ?>

<?php get_template_part( 'components/content', 'hero' ); ?>

<div class="row column">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<div id="home-what-we-do" class="row home-section" data-equalizer data-equalize-on="medium" >

			<div class="medium-6 medium-push-6 large-5 large-push-7 columns" data-equalizer-watch >
				<h2>Lo que hacemos</h2>
				<?php the_field('home_what_we_do'); ?>
			</div><!-- .columns -->

			<?php
			$image_do = get_field('home_what_we_do_image');
			if( !empty($image_do) ):
				$bg_do = $image_do['url'];
			endif;
			?>

			<div class="medium-6 medium-pull-6 large-7 large-pull-5 columns home-section-image" style="background-image: url('<?php echo $bg_do ?>')" data-equalizer-watch >
				&nbsp;
			</div>

		</div><!-- .row .home-section -->

		<div id="home-mission" class="row home-section" data-equalizer data-equalize-on="medium" >

			<div class="medium-6 large-7 columns" data-equalizer-watch >
				<h2>Misión</h2>
				<?php the_field('home_mission'); ?>
			</div><!-- .columns -->

			<?php
			$image_mission = get_field('home_mission_image');
			if( !empty($image_mission) ):
				$bg_mission = $image_mission['url'];
			endif;
			?>
			<div class="medium-6 large-5 columns home-section-image" style="background-image: url('<?php echo $bg_mission; ?>')" data-equalizer-watch >
				&nbsp;
				<?php
				// $image_mission = get_field('home_mission_image');
				// if( !empty($image_mission) ):
				// 	echo wp_get_attachment_image( $image_mission['ID'], 'full', false, array( 'class' => 'lazyload') );
				// endif;
				?>
			</div>
		</div><!-- .row .home-section -->

		<div class="row home-section">
			<?php echo do_shortcode( '[testimonials]' ); ?>
		</div><!-- .row .home-section -->
			
			<?php echo do_shortcode( '[free-download type="extended"]' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->


</div><!-- .row -->

<?php get_footer(); ?>
