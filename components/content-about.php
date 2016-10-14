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

	<div class="entry-content">

		<section class="about-main row">
			<div class="large-centered large-10 xxlarge-8 columns">
				<?php the_content(); ?>
			</div>
		</section>

		<section class="about-profiles row">

			<?php
			/**
			 * The WordPress Query class.
			 * @link http://codex.wordpress.org/Function_Reference/WP_Query
			 *
			 */
			$args = array(

				//Type & Status Parameters
				'post_type'   => 'profile',

				//Order & Orderby Parameters
				'order'               => 'ASC',

				//Pagination Parameters
				'posts_per_page'         => -1,

				//Parameters relating to caching
				'no_found_rows'          => false,
				'cache_results'          => true,
				'update_post_term_cache' => true,
				'update_post_meta_cache' => true,

			);

			$query = new WP_Query( $args );

			while ( $query->have_posts() ) : $query->the_post();

				// Count.
				$i = ! isset( $i ) ? 1 : $i;

				// Does this post count odd?
				$odd = $i % 2; // 1/0
				
				if ($odd) :
					$image_col_class = 'large-4 xxlarge-3 xxlarge-offset-1';
					$content_col_class = 'large-7 large-6 xxlarge-6';
				else:
					$image_col_class = 'large-4 large-push-8 xxlarge-3 xxlarge-offset-2 xxlarge-push-6';
					$content_col_class = 'large-7 large-pull-3 xxlarge-6 xxlarge-pull-3';
				endif;
				?>

				<div class="profile row">
					<div class="<?php echo $image_col_class; ?> columns">
						<div class="profile-image">
							<?php the_post_thumbnail(); ?>
						</div>
					</div>
					<div class="profile-content <?php echo $content_col_class; ?> columns end">
						<?php
						the_title( '<h2 class="profile-title">', '</h2>' );
						the_content();
						?>
					</div>
				</div>

				<?php

				// Count up.
				$i++;
		endwhile;
		?>

		</section>

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
