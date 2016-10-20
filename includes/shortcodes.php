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

function mailchimp_form_for_download() {
   	$form = do_shortcode('[mc4wp_form id="44"]');
   	$form = str_replace('Inscribite', 'Recibí ebook gratuito', $form);


	$mailchimp = '<div class="free-download-form">
		<div class="free-download-container">
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

		$return_string .= mailchimp_form_for_download();

		$return_string .= '<div class="free-download-info>
			<div class="free-download-container">
			</div>
		</div>';

	else :
		$return_string .= '<h2 class="free-download-title">
			E-book gratuito
			<span class="subtitle">Primeros pasos - Creando tu propio negocio</span>
		</h2>';
		$return_string .= mailchimp_form_for_download();
	endif;

	


	if ($type == 'extended') :
   		$return_string .= 'EXTENDED';
   	endif;

	$return_string .= '</aside>';

	return $return_string;
}


