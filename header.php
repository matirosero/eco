<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Eco
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php echo file_get_contents( get_template_directory() . '/assets/dist/sprite/sprite.svg' ); ?>

<!-- TOPBAR -->
<div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title"><?php bloginfo( 'name' ); ?></div>
</div>

<div class="top-bar" id="main-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text"><?php bloginfo( 'name' ); ?></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <?php 
    wp_nav_menu(
      array(
      'container' => false,
      'menu' => __( 'Topbar menu', 'eco' ),
      'menu_class' => 'menu',
      'theme_location' => 'primary',
      'items_wrap'      => '<ul id="%1$s" class="%2$s" data-responsive-menu="drilldown medium-dropdown">%3$s</ul>',
      //Recommend setting this to false, but if you need a fallback...
      // 'fallback_cb' => false,
      'walker' => new F6_TOPBAR_MENU_WALKER(),
    ));
    ?>
  </div>
</div>
<!-- END TOPBAR -->

<!-- TOPBAR -->
<div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title"><?php bloginfo( 'name' ); ?></div>
</div>

<div class="top-bar" id="main-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text"><?php bloginfo( 'name' ); ?></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu" data-responsive-menu="drilldown medium-dropdown">
      <li class="has-submenu">
        <a href="#">One</a>
        <ul class="submenu menu vertical" data-submenu>
          <li><a href="#">One</a></li>
          <li><a href="#">Two</a></li>
          <li><a href="#">Three</a></li>
        </ul>
      </li>
      <li><a href="#">Two</a></li>
      <li><a href="#">Three</a></li>
    </ul>
  </div>
</div>
<!-- END TOPBAR -->

<div class="off-canvas-wrapper">
  <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
    <div class="title-bar show-for-small-only">
      <div class="title-bar-left">
        <button class="menu-icon" type="button" data-toggle="offCanvasLeft"></button>
        <span class="title-bar-title"><?php bloginfo( 'name' ); ?></span>
      </div>
    </div><!-- .title-bar -->
    <div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
			<button class="close-button" aria-label="Close menu" type="button" data-close>
				<span aria-hidden="true">&times;</span>
			</button>
			<?php
			 // $args = array (
				//  'theme_location' 	=> 'primary',
				//  'container' 				=> 'nav',
				//  'container_class'	=> 'offcanvas-navigation',
				//  'menu_class' 			=> 'mobile-menu',
			 // );
				// wp_nav_menu( $args );
			?>
    </div><!-- #offCanvasLeft -->
    <div class="off-canvas-content" data-off-canvas-content>

			<header id="masthead" class="" role="banner">
				<section class="expanded row column">
					<h1 class="site-title">
						<a href="<?php esc_attr_e( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</section>
				<nav id="site-navigation" class="top-bar show-for-medium" data-topbar role="navigation">
					<section class="top-bar-section row column">
						<?php //wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</section>
				</nav><!-- #site-navigation -->
			</header><!-- #masthead -->

			<div id="content" class="site-content">
