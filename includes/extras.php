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

	//Utility Bar
	if ( ( isset( $ajax ) && $ajax ) || ( property_exists( $args, 'theme_location' ) && ( $args->theme_location === 'utility' || $args->theme_location === 'mobile-nav' ) ) ) {

		// Easy Digital Downloads
		if ( class_exists( 'Easy_Digital_Downloads' ) ) {

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

			// if ( edd_get_cart_quantity() != 0 ) {

				$css_class = 'menu-item menu-item-type-cart menu-item-type-edd-cart';

				// Is this the cart page?
				if ( edd_is_checkout() )
					$css_class .= ' current-menu-item';

				$items .= '<li class="' . esc_attr( $css_class ) . '">';
					$items .= '<a class="cart-contents" href="' . esc_url( edd_get_checkout_uri() ) . '">';
						$items .= '<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="header-cart edd-cart-quantity">' . edd_get_cart_quantity() . '</span>';
					$items .= '</a>';
				$items .= '</li>';

			// }

		}
	}

	// Top Navigation Area Only
	if ( ( isset( $ajax ) && $ajax ) || ( property_exists( $args, 'theme_location' ) && ( $args->theme_location === 'primary' || $args->theme_location === 'mobile-nav' ) ) ) {

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
	return '... </p><p><a class="button read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'eco') . ' <i class="fa fa-arrow-right" aria-hidden="true"></i></a>';
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


/**
 * Easy Digital Downloads - update the cart quantity with "Item" or "Items" when the ajax call is fired
 */
function sumobi_edd_quantity_updated_js() {
	?>
<script>
	jQuery(document).ready(function($) {
		$('body').on('edd_quantity_updated', function( response ) {

            $('span.edd-cart-quantity').each(function() {
            	var quantity = parseInt($(this).text(), 10);

            	if ( quantity == 1 ) {
            		text = ' Item';
            	} else {
            		text = ' Items';
            	}

            	$(this).append( text);
            });
		});
	});
</script>
<?php }
add_action( 'wp_footer', 'sumobi_edd_quantity_updated_js' );



/**
 * Add author to blog post
 */
function eco_author_info_box( $content ) {

	global $post;

	// Detect if it is a single post with a post author
	if ( is_single() && isset( $post->post_author ) ) {

		// Get author's display name
		$display_name = get_the_author_meta( 'display_name', $post->post_author );

		// If display name is not available then use nickname as display name
		if ( empty( $display_name ) )
			$display_name = get_the_author_meta( 'nickname', $post->post_author );

		// Get author's biographical information or description
		$user_description = get_the_author_meta( 'user_description', $post->post_author );

		// Get author's website URL
		$user_website = get_the_author_meta('url', $post->post_author);

		// Get link to the author archive page
		$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));

		if ( ! empty( $display_name ) )
			$author_details = '<h3 class="author-name">Sobre <strong>' . $display_name . '</strong></h3>';

		$author_details .= '<div class="author-avatar">' . get_avatar( get_the_author_meta('user_email') , 100 ) . '</div>';

		if ( ! empty( $user_description ) )
		// Author avatar and bio

			$author_details .= '<p class="author-details">' . nl2br( $user_description ). '</p>';

		$author_details .= '<p class="author-links"><a href="'. $user_posts .'">Ver todos los artículos de ' . $display_name . '</a>';

		// Check if author has a website in their profile
		if ( ! empty( $user_website ) ) {

			// Display author website link
			$author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';

		} else {
			// if there is no author website then just close the paragraph
			$author_details .= '</p>';
		}

		// Pass all this info to post content
		$content = $content . '<footer class="author-bio" >' . $author_details . '</footer>';
	}
	return $content;
}

// Add our function to the post content filter
add_action( 'the_content', 'eco_author_info_box' );

// Allow HTML in author bio section
remove_filter('pre_user_description', 'wp_filter_kses');
