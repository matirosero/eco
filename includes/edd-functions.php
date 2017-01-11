<?php

add_action( 'edd_register_account_fields_before' , 'eco_create_account_explanation' );
function eco_create_account_explanation() {

  // Echo the html
  echo '<p>Es necesario crear una cuenta en nuestro sitio para poder acceder a los cursos.</p>';
}

remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );



/**
 * Get the payment ID from a user ID and download IE
 *
 * @param int $download_id Download ID, int $user_ID User ID,
 * @return int $payment_id
*/
function edd_get_payment_id($user_ID, $download_id) {

	//If user has purchased this, find payment ID
	if( edd_has_user_purchased($user_ID, $download_id) ) {

		//Use Log IDs to get Payments IDs

		// Instantiate a new instance of the class
		$edd_logging = new EDD_Logging;

		// get logs for this download with type of 'sale'
		$logs = $edd_logging->get_logs( $download_id, 'sale' );

		// if logs exist
		if ( $logs ) {
			// create array to store our log IDs into
			$log_ids = array();
			// add each log ID to the array
			foreach ( $logs as $log ) {
				$log_ids[] = $log->ID;
			}
			// return our array

			$payment_ids = array();

			foreach ( $log_ids as $log_id ) {
				// get the payment ID for each corresponding log ID
				// $payment_ids[] = get_post_meta( $log_id, '_edd_log_payment_id', true );
				$payment_id = get_post_meta( $log_id, '_edd_log_payment_id', true );

				$payment = new EDD_Payment($payment_id);

				//http://stackoverflow.com/questions/8102221/php-multidimensional-array-searching-find-key-by-specific-value
				if ( $payment->user_id == $user_ID) {
					// echo 'PAYMENT USER ID <strong>'.$payment->user_id.'</strong> matches USER ID <strong>'.$user_ID.'</strong><br /> Return PAYMENT ID <strong>'.$payment_id.'</strong><br />';
					$the_payment_ID = $payment_id;

					return $the_payment_ID;
				}

			}

		}
	}
	return false;

}

/**
 * Get an array of all the log IDs using the EDD Logging Class
 *
 * @return array if logs, null otherwise
 * @param $download_id Download's ID
*/
function get_log_ids( $download_id = '' ) {

	// Instantiate a new instance of the class
	$edd_logging = new EDD_Logging;

	// get logs for this download with type of 'sale'
	$logs = $edd_logging->get_logs( $download_id, 'sale' );

	// if logs exist
	if ( $logs ) {
		// create array to store our log IDs into
		$log_ids = array();
		// add each log ID to the array
		foreach ( $logs as $log ) {
			$log_ids[] = $log->ID;
		}
		// return our array
		return $log_ids;
	}

	return null;

}


/**
 * Get array of payment IDs
 *
 * @param int $download_id Download ID
 * @return array $payment_ids
*/
function get_payment_ids( $download_id = '' ) {
	// these functions are used within a class, so you may need to update the function call
	$log_ids = $this->get_log_ids( $download_id );

	if ( $log_ids ) {
		// create $payment_ids array
		$payment_ids = array();

		foreach ( $log_ids as $id ) {
			// get the payment ID for each corresponding log ID
			$payment_ids[] = get_post_meta( $id, '_edd_log_payment_id', true );
		}

		// return our payment IDs
		return $payment_ids;
	}

	return null;
}








/**
 * Downloads Shortcode
 *
 * This shortcodes uses the WordPress Query API to get downloads with the
 * arguments specified when using the shortcode. A list of the arguments
 * can be found from the EDD Dccumentation. The shortcode will take all the
 * parameters and display the downloads queried in a valid HTML <div> tags.
 *
 * @since 1.0.6
 * @internal Incomplete shortcode
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string $display Output generated from the downloads queried
 */

define('EDD_SLUG', 'productos');

function eco_edd_downloads_query( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'show_category'    => 'no',
		'category'         => '',
		'exclude_category' => '',
		'tags'             => '',
		'exclude_tags'     => '',
		'relation'         => 'OR',
		'number'           => 9,
		'price'            => 'no',
		'excerpt'          => 'yes',
		'full_content'     => 'no',
		'buy_button'       => 'yes',
		'columns'          => 3,
		'thumbnails'       => 'true',
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'ids'              => '',
		'pagination'       => 'true'
	), $atts, 'downloads' );

	$query = array(
		'post_type'      => 'download',
		'orderby'        => $atts['orderby'],
		'order'          => $atts['order']
	);

	if ( filter_var( $atts['pagination'], FILTER_VALIDATE_BOOLEAN ) || ( ! filter_var( $atts['pagination'], FILTER_VALIDATE_BOOLEAN ) && $atts[ 'number' ] ) ) {

		$query['posts_per_page'] = (int) $atts['number'];

		if ( $query['posts_per_page'] < 0 ) {
			$query['posts_per_page'] = abs( $query['posts_per_page'] );
		}
	} else {
		$query['nopaging'] = true;
	}

	if( 'random' == $atts['orderby'] ) {
		$atts['pagination'] = false;
	}

	switch ( $atts['orderby'] ) {
		case 'price':
			$atts['orderby']   = 'meta_value';
			$query['meta_key'] = 'edd_price';
			$query['orderby']  = 'meta_value_num';
		break;

		case 'title':
			$query['orderby'] = 'title';
		break;

		case 'id':
			$query['orderby'] = 'ID';
		break;

		case 'random':
			$query['orderby'] = 'rand';
		break;

		case 'post__in':
			$query['orderby'] = 'post__in';
		break;

		default:
			$query['orderby'] = 'post_date';
		break;
	}

	if ( $atts['tags'] || $atts['category'] || $atts['exclude_category'] || $atts['exclude_tags'] ) {

		$query['tax_query'] = array(
			'relation' => $atts['relation']
		);

		if ( $atts['tags'] ) {

			$tag_list = explode( ',', $atts['tags'] );

			foreach( $tag_list as $tag ) {

				$t_id  = (int) $tag;
				$is_id = is_int( $t_id ) && ! empty( $t_id );

				if( $is_id ) {

					$term_id = $tag;

				} else {

					$term = get_term_by( 'slug', $tag, 'download_tag' );

					if( ! $term ) {
						continue;
					}

					$term_id = $term->term_id;
				}

				$query['tax_query'][] = array(
					'taxonomy' => 'download_tag',
					'field'    => 'term_id',
					'terms'    => $term_id
				);
			}

		}

		if ( $atts['category'] ) {

			$categories = explode( ',', $atts['category'] );

			foreach( $categories as $category ) {

				$t_id  = (int) $category;
				$is_id = is_int( $t_id ) && ! empty( $t_id );

				if( $is_id ) {

					$term_id = $category;

				} else {

					$term = get_term_by( 'slug', $category, 'download_category' );

					if( ! $term ) {
						continue;
					}

					$term_id = $term->term_id;

				}

				$query['tax_query'][] = array(
					'taxonomy' => 'download_category',
					'field'    => 'term_id',
					'terms'    => $term_id,
				);

			}

		}

		if ( $atts['exclude_category'] ) {

			$categories = explode( ',', $atts['exclude_category'] );

			foreach( $categories as $category ) {

				$t_id  = (int) $category;
				$is_id = is_int( $t_id ) && ! empty( $t_id );

				if( $is_id ) {

					$term_id = $category;

				} else {

					$term = get_term_by( 'slug', $category, 'download_category' );

					if( ! $term ) {
						continue;
					}

					$term_id = $term->term_id;
				}

				$query['tax_query'][] = array(
					'taxonomy' => 'download_category',
					'field'    => 'term_id',
					'terms'    => $term_id,
					'operator' => 'NOT IN'
				);
			}

		}

		if ( $atts['exclude_tags'] ) {

			$tag_list = explode( ',', $atts['exclude_tags'] );

			foreach( $tag_list as $tag ) {

				$t_id  = (int) $tag;
				$is_id = is_int( $t_id ) && ! empty( $t_id );

				if( $is_id ) {

					$term_id = $tag;

				} else {

					$term = get_term_by( 'slug', $tag, 'download_tag' );

					if( ! $term ) {
						continue;
					}

					$term_id = $term->term_id;
				}

				$query['tax_query'][] = array(
					'taxonomy' => 'download_tag',
					'field'    => 'term_id',
					'terms'    => $term_id,
					'operator' => 'NOT IN'
				);

			}

		}
	}

	if ( $atts['exclude_tags'] || $atts['exclude_category'] ) {
		$query['tax_query']['relation'] = 'AND';
	}

	if( ! empty( $atts['ids'] ) )
		$query['post__in'] = explode( ',', $atts['ids'] );

	if ( get_query_var( 'paged' ) )
		$query['paged'] = get_query_var('paged');
	else if ( get_query_var( 'page' ) )
		$query['paged'] = get_query_var( 'page' );
	else
		$query['paged'] = 1;

	// Allow the query to be manipulated by other plugins
	$query = apply_filters( 'edd_downloads_query', $query, $atts );

	$downloads = new WP_Query( $query );
	if ( $downloads->have_posts() ) :
		$i = 1;
		$wrapper_class = 'edd_download_columns_' . $atts['columns'];
		ob_start(); ?>

		<ul class="shop-list">

		<!-- <div class="edd_downloads_list <?php echo apply_filters( 'edd_downloads_list_wrapper_class', $wrapper_class, $atts ); ?>"> -->

			<?php while ( $downloads->have_posts() ) : $downloads->the_post(); ?>
				<?php $schema = edd_add_schema_microdata() ? 'itemscope itemtype="http://schema.org/Product" ' : ''; ?>

				<li <?php echo $schema; ?>class="row shop-item <?php echo apply_filters( 'edd_download_class', 'edd_download', get_the_ID(), $atts, $i ); ?>" id="edd_download_<?php echo get_the_ID(); ?>">

				<!-- <div <?php echo $schema; ?>class="<?php echo apply_filters( 'edd_download_class', 'edd_download', get_the_ID(), $atts, $i ); ?>" id="edd_download_<?php echo get_the_ID(); ?>"> -->

					<!-- <div class="edd_download_inner"> -->
						<?php

						do_action( 'edd_download_before' );

						if ( 'false' != $atts['thumbnails'] ) :
							echo '<div class="medium-4 columns">';
								edd_get_template_part( 'shortcode', 'content-image' );
								do_action( 'edd_download_after_thumbnail' );

							if ( $atts['show_category'] == 'yes' ) {
								edd_get_template_part( 'shortcode', 'content-taxonomies' );
								// do_action( 'edd_download_after_taxonomies' );
							}
							echo '</div>';
						endif;

						echo '<div class="medium-8 columns">';


							edd_get_template_part( 'shortcode', 'content-title' );
							echo '<h4 class="shop-item-subtitle">'.get_field('downloads_subtitle').'</h4>';
							do_action( 'edd_download_after_title' );

							if ( $atts['excerpt'] == 'yes' && $atts['full_content'] != 'yes' ) {
								edd_get_template_part( 'shortcode', 'content-excerpt' );
								do_action( 'edd_download_after_content' );
							} else if ( $atts['full_content'] == 'yes' ) {
								edd_get_template_part( 'shortcode', 'content-full' );
								do_action( 'edd_download_after_content' );
							}
							echo '<a class="button" itemprop="url" href="'.get_permalink().'">Más información</a>';
						echo '</div>';

						

						do_action( 'edd_download_after' );

						?>
					<!-- </div> --><!-- .edd_download_inner -->

				</li><!-- .row .shop-item .edd_download -->
				<!-- </div> -->

				<?php if ( $atts['columns'] != 0 && $i % $atts['columns'] == 0 ) { ?><div style="clear:both;"></div><?php } ?>
			<?php $i++; endwhile; ?>

			<!-- <div style="clear:both;"></div> -->

			<?php wp_reset_postdata(); ?>

			<?php if ( filter_var( $atts['pagination'], FILTER_VALIDATE_BOOLEAN ) ) : ?>

			<?php
				$pagination = false;

				if ( is_single() ) {
					$pagination = paginate_links( apply_filters( 'edd_download_pagination_args', array(
						'base'    => get_permalink() . '%#%',
						'format'  => '?paged=%#%',
						'current' => max( 1, $query['paged'] ),
						'total'   => $downloads->max_num_pages
					), $atts, $downloads, $query ) );
				} else {
					$big = 999999;
					$search_for   = array( $big, '#038;' );
					$replace_with = array( '%#%', '&' );
					$pagination = paginate_links( apply_filters( 'edd_download_pagination_args', array(
						'base'    => str_replace( $search_for, $replace_with, get_pagenum_link( $big ) ),
						'format'  => '?paged=%#%',
						'current' => max( 1, $query['paged'] ),
						'total'   => $downloads->max_num_pages
					), $atts, $downloads, $query ) );
				}
			?>

			<?php if ( ! empty( $pagination ) ) : ?>
			<div id="edd_download_pagination" class="navigation">
				<?php echo $pagination; ?>
			</div>
			<?php endif; ?>

			<?php endif; ?>

		</ul><!-- .shop-list -->
		<!-- </div> -->

		<?php
		$display = ob_get_clean();
	else:
		$display = sprintf( _x( 'No %s found', 'download post type name', 'easy-digital-downloads' ), edd_get_label_plural() );
	endif;

	return apply_filters( 'downloads_shortcode', $display, $atts, $atts['buy_button'], $atts['columns'], '', $downloads, $atts['excerpt'], $atts['full_content'], $atts['price'], $atts['thumbnails'], $query );
}
add_shortcode( 'eco_downloads', 'eco_edd_downloads_query' );

