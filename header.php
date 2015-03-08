<!doctype html>

<html <?php language_attributes(); ?> >

<head>
  <meta charset="utf-8">

  <?php // force Internet Explorer to use the latest rendering engine available ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>
    <?php wp_title(); ?>
  </title>

  <?php // mobile meta (hooray!) ?>
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
  <!--[if IE]>
      <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
  <![endif]-->
  <?php // or, set /favicon.ico for IE10 win ?>
  <meta name="msapplication-TileColor" content="#f01d4f">
  <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php // wordpress head functions ?>
  <?php wp_head(); ?>
  <?php // end of wordpress head ?>

  <?php // drop Google Analytics Here ?>
  <?php // end analytics ?>

  <?php //getting Databases, custom functions ?>
  <?php include( "JR_Shop/JR_Shop_Core.php"); ?>

</head>

<body <?php body_class(); ?>>

  <header class="page-header" role="banner">
    <div class="container" >

      <a class="header-icon" href="<?php echo home_url(); ?>" rel="nofollow">
        <img src="<?php echo imgSrcRoot('rhc','RHC_Logo_transparent','png'); ?>" />
      </a>

      <div class="header-social" >social here</div>

      <menu class="header-menu">
        <form>
          <label for="search">Search</label>
          <input type="hidden" name="page_id" value="<?php echo jr_page('srch') ?>">
          <input type="search" name="search">
          <button type="submit">GO</button>
        </form>
        <?php wp_nav_menu(array(
        'container' => '',                              // remove nav container
        'menu' => __( 'Header Links', 'bonestheme' ),   // nav name
        'menu_class' => '',                             // adding custom nav class
        'theme_location' => 'header-links',             // where it's located in the theme
        'fallback_cb' => ''                             // fallback function
        )); ?>

      </menu>

    </div>
  </header>

