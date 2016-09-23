<?php

namespace Eco;

/**
 * Enqueue styles
 */
add_action( 'wp_enqueue_scripts', function() {

	wp_enqueue_style(
		'eco_styles',
		ECO_URL . '/assets/dist/css/app.css',
		'',
		ECO_VERSION,
		''
	);

	//Google fonts: PT Serif & Reenie Beanie
	// font-family: 'PT Serif', serif;
	// font-family: 'Reenie Beanie', cursive;
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700i|Reenie+Beanie&subset=latin-ext', false ); 
	}

} );

/**
 * Enqueue scripts
 */
add_action( 'wp_enqueue_scripts', function() {

	// Add Foundation JS to footer
	wp_enqueue_script(
		'foundation-js',
		ECO_URL . '/assets/dist/js/foundation.js',
		['jquery'],
		'6.2.3',
		true
	);

	// Add our main app js file
	wp_enqueue_script(
		'eco_appjs',
		ECO_URL . '/assets/dist/js/app.js',
		['jquery'],
		ECO_VERSION,
		true
	);

	wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/7584c7752e.js', array(), '4.6.3', false );

	// Add comment script on single posts with comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} );