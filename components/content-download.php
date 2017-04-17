<?php
/**
 * Template part for displaying Download content in single-download.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Eco
 */
?>

<?php
global $user_ID; // the ID of the currently logged-in user
$download_id = get_the_ID(); // download ID
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( !has_post_thumbnail() ) : ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<?php if( !edd_has_user_purchased($user_ID, $download_id) && !current_user_can('administrator') ): ?>

		<section id="product-public" class="page-section">

			<?php the_field('downloads_public'); ?>


				<?php
				$buyboxclass = "buy-box";
				if ( get_field('downloads_dicount_price') ):
					$buyboxclass .= " has-discount row";
				endif;
				?>
				<div class="<?php echo $buyboxclass; ?>">
					<?php if(function_exists('edd_price')) { ?>
						<?php if(!edd_has_variable_prices(get_the_ID())) {
							echo '<div class="buy-box-price small-6 columns">';
							echo '<p class="buy-box-title">Precio</p>';
							edd_get_template_part( 'shortcode', 'content-price' );
							echo '</div>';

							echo '<div class="buy-box-button small-6 columns">';

							if ( get_field('downloads_dicount_price') ):

								echo '<span class="discount-price">';
								the_field('downloads_dicount_price');
								echo '</span>';
								echo '<p class="buy-box-notes">'.get_field('downloads_buybox_text').'</p>';
							endif;

							echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button');
							echo '</div>';
							?>
						<?php } ?>
					<?php } ?>
				</div><!--end .buy-box-->




		</section><!-- #product-public -->
	<?php endif; ?>
	<?php if( edd_has_user_purchased($user_ID, $download_id) || current_user_can('administrator') ): ?>
		<section id="product-private" class="page-section">
			<?php the_field('downloads_private'); ?>

			<?php
			// check if the repeater field has rows of data
			if( have_rows('downloads_modules') ):

				echo '<ul class="accordion" data-accordion>';

			 	// loop through the rows of data
			    while ( have_rows('downloads_modules') ) : the_row(); ?>

					<li class="accordion-item" data-accordion-item>
						<a href="#" class="accordion-title"><?php the_sub_field('module_title'); ?></a>
						<div class="accordion-content" data-tab-content>
							 <?php the_sub_field('module_content'); ?>
						</div>
					</li>

			    <?php endwhile;

			    echo '</ul>';

			endif; ?>
			



		</section><!-- #product-private -->
	<?php endif; ?>



<?php /*
		<aside class="sidebar" data-sticky-container>
			<div class="sticky" data-sticky data-anchor="course-content">
				<div class="download-details">

					<?php

					if( edd_has_user_purchased($user_ID, $download_id) ) {

						//Show download files
						$purchase_data  = edd_get_payment_meta( edd_get_payment_id($user_ID, $download_id) );
						// var_dump(get_payment_ids());
						$download_files = edd_get_download_files( get_the_ID(), $price_id );

						if( $download_files ) { ?>
							<h4>Descargas</h4>
							<ul class="download-list-files">
							<?php
							foreach( $download_files as $filekey => $file ) {

								//HOW TO GET PURCHASE_DATA AND PAYMENT ID???
								$download_url = edd_get_download_file_url( $purchase_data['key'], $email, $filekey, get_the_ID(), $price_id );
								?>

								<li class="download-file">
									<a href="<?php echo esc_url( $download_url ); ?>">
										<?php echo $file['name']; ?>
									</a>

								</li>
							<?php } ?>
							</ul>
						<?php }

					} else {
						// Show pay link
						if(function_exists('edd_price')) { ?>
							<div class="product-buttons">
								<?php if(!edd_has_variable_prices(get_the_ID())) { ?>
									<?php echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button'); ?>
								<?php } ?>

							</div><!--end .product-buttons-->
						<?php }
					}

					?>


				</div>
			</div>
		</aside>
*/ ?>



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
