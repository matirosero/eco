<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Eco
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function eco_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'eco_body_classes' );


/**
 * Make YouTube and Vimeo oembed elements responsive. Add Foundation's .flex-video
 * class wrapper around any oembeds
 */
function eco_oembed_flex_wrapper( $html, $url, $attr, $post_ID ) {
	if ( strpos( $url, 'youtube' ) || strpos( $url, 'youtu.be' ) || strpos( $url, 'vimeo' ) ) {
		return '<div class="flex-video widescreen">' . $html . '</div>';
	}

	return $html;
}
add_filter( 'embed_oembed_html', 'eco_oembed_flex_wrapper', 10, 4 );


/**
 * This function adds the WooCommerce or Easy Digital Downloads cart icons/items to the top_nav menu area as the last item.
 */
add_filter( 'wp_nav_menu_items', 'my_wp_nav_menu_items', 10, 2 );

function my_wp_nav_menu_items( $items, $args, $ajax = false ) {
	// Top Navigation Area Only
	if ( ( isset( $ajax ) && $ajax ) || ( property_exists( $args, 'theme_location' ) && ( $args->theme_location === 'primary' || $args->theme_location === 'mobile-nav' ) ) ) {

		// Easy Digital Downloads
		if ( class_exists( 'Easy_Digital_Downloads' ) ) {

			if ( edd_get_cart_quantity() != 0 ) {

				$css_class = 'menu-item menu-item-type-cart menu-item-type-edd-cart';

				// Is this the cart page?
				if ( edd_is_checkout() )
					$css_class .= ' current-menu-item';

				$items .= '<li class="' . esc_attr( $css_class ) . '">';
					$items .= '<a class="cart-contents" href="' . esc_url( edd_get_checkout_uri() ) . '">';
						$items .= wp_kses_data( edd_cart_subtotal() ) . ' - <span class="count">' .  wp_kses_data( sprintf( _n( '%d item', '%d items', edd_get_cart_quantity(), 'foundationpress' ), edd_get_cart_quantity() ) ) . '</span>';
					$items .= '</a>';
				$items .= '</li>';

			}

			//Add Login dropdown to menu
			if ( !is_user_logged_in() ) {
				$login = '<li class="menu-item menu-item-has-children is-dropdown-submenu-parent opens-left">
						<a href="#">Entrar</a>
						<ul class="menu submenu is-dropdown-submenu first-sub vertical" data-submenu="" aria-hidden="true" role="menu">
							<li id="menu-item-380" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-380 is-submenu-item is-dropdown-submenu-item" role="menuitem">'.do_shortcode( '[edd_login]' ).'</li>
						</ul>
					</li>';

				$items .= $login;
			} 

		}


		$social_sites = my_customizer_social_media_array();

		/* any inputs that aren't empty are stored in $active_sites array */
	    foreach($social_sites as $social_site) {
	        if( strlen( get_theme_mod( $social_site ) ) > 0 ) {
	            $active_sites[] = $social_site;
	        }
	    }

	    /* for each active social site, add it as a list item */
	    if ( ! empty( $active_sites ) ) {

	        // echo "<ul class='social-media-icons'>";

	        foreach ( $active_sites as $active_site ) {

	            /* setup the class */
		        $class = 'menu-item menu-item-social menu-item-' . $active_site;

	            if ( $active_site == 'email' ) {
	                $items .= '<li class="'.esc_attr( $class ).'">
	                    <a target="_blank" href="mailto:' . antispambot( is_email( get_theme_mod( $active_site ) ) ) . '">
	                        <i class="fa fa-lg fa-envelope"></i> <span>'.ucfirst($active_site).'</span></a>
	                </li>';
	            } else {
	                $items .= '<li class="'.esc_attr( $class ).'">
	                    <a target="_blank" href="'.esc_url( get_theme_mod( $active_site) ).'"> <i class="fa fa-lg fa-'.$active_site.'"></i> <span>'.ucfirst($active_site).'</span></a>
	                </li>';
	            }
	        }
	        // echo "</ul>";
	    }
	}

	return $items;
}

/**
 * Modify Excerpt: change [...] tp Read More 
 */
function new_excerpt_more( $more ) {
	return '... </p><p><a class="button read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'foundationpress') . ' <i class="fa fa-arrow-right" aria-hidden="true"></i></a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


/**
 * For debugging https://www.smashingmagazine.com/2011/03/ten-things-every-wordpress-plugin-developer-should-know/ 
 */
function log_me($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}

/**
 * Page Slug Body Class
 */
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );