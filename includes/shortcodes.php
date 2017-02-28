<?php

/**
 * Enable shortcodes in text widgets
 */
add_filter('widget_text','do_shortcode');


/**
 * Register all shortcodes
 *
 * @return null
 */
function register_shortcodes(){
   add_shortcode('recent-posts', 'recent_posts_function');
   add_shortcode('free-download', 'free_download_function');
   add_shortcode('testimonials', 'testimonials_shortcode');
}
add_action( 'init', 'register_shortcodes');


/**
 * Recent posts callback
 *
 */
function recent_posts_function($atts) {

   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));

   $return_string = '<ul>';

   query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts));
   if (have_posts()) :
      while (have_posts()) : the_post();
         $return_string .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
      endwhile;
   endif;
   $return_string .= '</ul>';

   wp_reset_query();
   return $return_string;
}


/**
 * Alter mailchimp form so it mentions free download
 *
 */
function mailchimp_form_for_download($equalizer=false) {
   	$form = do_shortcode('[mc4wp_form id="44"]');
   	$form = str_replace('Inscribite', 'Recibí guía gratuita', $form);

   	if ($equalizer) :
   		$equalize = ' data-equalizer-watch';
   	endif;

	$mailchimp = '<div class="free-download-form"'.$equalize.'>
		<div class="free-download-container">
			<h2>Gratis</h2>
			<p>Ingresa tus datos para obtener la guía.</p>'
			.$form
		.'<p class="fineprint">Quedarás inscrito en nuestra lista. Revisá tu correo electrónico para descargarla. Te recomendamos que revisés el spam y agregués <a href="mailto:info@soyempresarioeco.com">info@soyempresarioeco.com</a> a tu lista de contactos.</p>
		</div>
	</div>';

	return $mailchimp;
}

/**
 * Free download with mailchimp signup callback
 *
 */
function free_download_function($atts) {

   	extract(shortcode_atts(array(
      	'type' => 'compact',
	), $atts));

	if ( $type == 'extended' ) :
		$class = 'extended';
	else:
		$class = 'compact';
	endif;

	$return_string = '<aside class="free-download '.$class.'">';

	if ( $type == 'extended' ) :

		$return_string .= '<div class="row" data-equalizer data-equalize-on="medium">
			<div class="medium-7 medium-push-5 large-8 large-push-4 columns">
				<div class="free-download-info" data-equalizer-watch>
					<div class="free-download-container">
						<h2>Guía gratuita
						<span class="subtitle">Primeros pasos - Creando tu propio negocio</span></h2>

						<p class="intro">¿Tenés una excelente idea y no sabés cómo llevarla a buen puerto? Aprendé los primeros pasos que debés dar para iniciar tu propio negocio.</p>
						<h3 class="show-for-large">Con este e-book aprenderás:</h3>
						<ul class="show-for-large">
							<li>Cómo escoger una idea para crear un negocio rentable.</li>
							<li>Qué habilidades debés desarrollar si querés emprender un proyecto.</li>
							<li>Determinar el mercado de tu emprendimiento.</li>
							<li>Diseñar un plan de negocios sencillo que te permita tomar acciones concretas.</li>
							<li>Herramientas de productividad para implementar tus primeros pasos de emprendedor de manera paralela con tu actual trabajo.</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="medium-5 medium-pull-7 large-4 large-pull-8 columns">'
				.mailchimp_form_for_download(true)
			.'</div>
		</div>';


	else :
		$return_string .= '<h2 class="free-download-title">
			Guía gratuita
			<span class="subtitle">Primeros pasos - Creando tu propio negocio</span>
		</h2>';
		$return_string .= mailchimp_form_for_download();
	endif;

	$return_string .= '</aside>';

	return $return_string;
}


/**
 * Testimonials callback
 *
 */
function testimonials_shortcode() {
    global $wp_query,
    	$post;

	$args = array(

		//Type & Status Parameters
		'post_type'   => 'testimonial',
		'post_status' => 'publish',

		//Order & Orderby Parameters
		'order'               => 'DESC',
		'orderby'             => 'date',

		//Pagination Parameters
		'posts_per_page'         => -1,

		//Permission Parameters -
		'perm' => 'readable',

		//Parameters relating to caching
		'no_found_rows'          => false,
		'cache_results'          => true,
		'update_post_term_cache' => true,
		'update_post_meta_cache' => true,

	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) : ?>

		<div class="row medium-up-2">

		<?php while ( $query->have_posts() ) : $query->the_post(); ?>

			<article class="column column-block">
				<?php the_content(); ?>
				<?php the_title(); ?>
			</article>

		<?php endwhile; ?>

		</div>

	<?php endif;

    wp_reset_postdata();
}