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

<header id="masthead" class="" role="banner">
  <section class="expanded row small-collapse">

    <!-- TOPBAR -->
    <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
      <button class="menu-icon" type="button" data-toggle></button>
      <div class="title-bar-title"><?php bloginfo( 'name' ); ?></div>
    </div>

    <nav id="main-menu" class="top-bar">
      <section class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
          <!-- <h1 class="site-title"> -->
          <li class="menu-text">            
            <a href="<?php esc_attr_e( home_url( '/' ) ); ?>" rel="home">
              <?php bloginfo( 'name' ); ?>
            </a></li>
        </ul>
      </section>
      <section class="top-bar-right">
        <?php eco_top_nav(); ?>
      </section>
    </nav><!-- #site-navigation -->
    <!-- END TOPBAR -->

  </section><!-- expanded row column -->
</header><!-- #masthead -->




			<div id="content" class="site-content">
