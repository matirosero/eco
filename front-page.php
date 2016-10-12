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

		<div class="row home-section">
			<div class="medium-6 large-7 columns">
				<img src="https://placekitten.com/800/600" />
			</div>
			<div class="medium-6 large-5 columns">
				<h2>Lo que hacemos</h2>
				<?php the_field('home_what_we_do'); ?>
			</div><!-- .columns -->
		</div><!-- .row .home-section -->

		<div class="row home-section">
			<div class="medium-6 large-7 columns">
				<h2>Misión</h2>
				<?php the_field('home_mission'); ?>
			</div><!-- .columns -->
			<div class="medium-6 large-5 columns">
				<img src="https://placekitten.com/800/600" />
			</div>
		</div><!-- .row .home-section -->

		<div class="row home-section">

		</div><!-- .row .home-section -->
			FREE DOWNLOAD THINGY HERE
		</main><!-- #main -->
	</div><!-- #primary -->


</div><!-- .row -->

<?php get_footer(); ?>
