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

	<div class="intro" role="main">
		<div class="intro-container">
			<p class="course-intro"><?php the_field('downloads_intro'); ?></p>
		</div>
	</div>

	<div id="single-download-main" >

		<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
		<div id="course-content" class="main-content">
			<?php the_field('downloads_public'); ?>

			<?php if( edd_has_user_purchased($user_ID, $download_id) ): ?>
				<div class="section-divider">
					<hr />
				</div>
				<?php the_content();
			endif; ?>
		</div>

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
	</div>

	
	<div class="entry-content">
		<?php the_content(); ?>
		<?php 
		if (is_page('Contactanos')) :
			echo do_shortcode( '[contact-form-7 id="89" title="Contactanos"]' ); 
		endif;
		?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eco' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

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
