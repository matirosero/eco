<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( !has_post_thumbnail() ) : ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<section id="service-info" class="page-section">

		<?php

		// check if the repeater field has rows of data
		if( have_rows('service_types') ):

			echo '<ol class="service-list">';

		 	// loop through the rows of data
		    while ( have_rows('service_types') ) : the_row();

		        echo '<li>
		        	<div class="row">
			        	<div class="large-8 columns">
					        <h3>'.get_sub_field('service_name').'</h3>
					        <p>'.get_sub_field('service_description').'</p>
					    </div>
					    <div class="large-4 columns">
					    	<a href="#service-request-form" class="button">Solicitá tu espacio aquí</a>
					    </div>
					</div>
				</li>';

		    endwhile;

		    echo '</ol>';

		else :

		    // no rows found

		endif;

		?>


	</section><!-- #service-info -->

	<section id="services-request" class="page-section">

				<?php
				$image_services = get_field('services_image');
				if( !empty($image_services) ):
					echo wp_get_attachment_image( $image_services, 'full', false, array( 'class' => 'lazyload') );
				endif;
				?>

		<a name="service-request-form"></a>
		<h2><?php the_field('services_form_header'); ?></h2>

		<?php the_field('services_form_text'); ?>

		<?php the_field('service_form'); ?>

	</section><!-- #service-form -->

	<footer class="entry-footer">
		<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'eco' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
