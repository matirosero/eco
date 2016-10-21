<?php

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

//Register shortcodes
function register_shortcodes(){
   add_shortcode('recent-posts', 'recent_posts_function');
   add_shortcode('free-download', 'free_download_function');
}
add_action( 'init', 'register_shortcodes');


//Recent posts
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

function mailchimp_form_for_download($equalizer=false) {
   	$form = do_shortcode('[mc4wp_form id="44"]');
   	$form = str_replace('Inscribite', 'Recibí ebook gratuito', $form);

   	if ($equalizer) :
   		$equalize = ' data-equalizer-watch';
   	endif;

	$mailchimp = '<div class="free-download-form">
		<div class="free-download-container"'.$equalize.'>
			<h2>Gratis</h2>
			<p>Al suscribirte a nuestra lista de correo</p>'
			.$form
		.'</div>
	</div>';

	return $mailchimp;
}

//Free download with signup
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
				<div class="free-download-info">
					<div class="free-download-container" data-equalizer-watch>
						<h2>E-book gratuito
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
			E-book gratuito
			<span class="subtitle">Primeros pasos - Creando tu propio negocio</span>
		</h2>';
		$return_string .= mailchimp_form_for_download();
	endif;

	$return_string .= '</aside>';

	return $return_string;
}


