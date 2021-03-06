<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Eco
 */
?>

			</div><!-- #content -->

			<footer id="colophon" class="site-footer" role="contentinfo">

				<div class="column row">

					<nav class="footer-social-menu">
					 	<?php my_social_media_icons(); ?>
					</nav>

					<p class="text-center">
						<!-- <svg class="icon">
							<use xlink:href="#icon-coffee-cup"></use>
						</svg> -->
						&copy; <?php echo date("Y"); ?> <?php echo get_bloginfo( 'name' ); ?>, todos los derechos reservados
						<br />
						Desarrollo web: <a href="http://matilderosero.com">Matilde Rosero</a>
					</p>

				</div><!-- .column.row -->

			</footer><!-- #colophon -->



<?php wp_footer(); ?>
</body>
</html>
