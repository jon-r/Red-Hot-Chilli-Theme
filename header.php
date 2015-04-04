<!doctype html>

<html <?php language_attributes(); ?> >

<head>
  <meta charset="utf-8">

  <?php // force Internet Explorer to use the latest rendering engine available ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>
    Fix <?php wp_title(); ?>
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

  <header class="primary-header" role="banner">

    <?php wp_nav_menu(array(
    'container' => '',                              // remove nav container
    'menu' => __( 'Header Links', 'bonestheme' ),   // nav name
    'menu_class' => 'menu-header',                             // adding custom nav class
    'theme_location' => 'header-links',             // where it's located in the theme
    'fallback_cb' => ''                             // fallback function
    )); ?>

    <div class="container" >

      <a class="header-logo" href="<?php echo home_url(); ?>" rel="nofollow">
        <img src="<?php echo imgSrcRoot('rhc','RHC_Logo_transparent','png'); ?>" />
      </a>

      <div class="header-links">
        <ul class="header-contact" >
          <li class="phone-w" ><h2><?php echo $rhcTel ?></h2></li>
          <li class="email-w" ><a href="mailto:<?php echo $rhcEmail ?>" ><h3><?php echo $rhcEmail ?></h3></a></li>
        </ul>
        <form class="header-search">
          <input type="hidden" name="page_id" value="<?php echo jr_page('srch') ?>">
          <input type="search" name="search">
          <label for="search">Search</label>
<!--          <button type="submit">GO</button>-->
        </form>
        <div class="header-social" >
          <a  class="facebook" href="<?php echo $rhcFacebookLink ?>" >Facebook</a>
          <a class="linkedin" href="<?php echo $rhcLinkedinLink ?>" >LinkedIn</a>
          <a class="twitter" href="<?php echo $rhcTwitterLink ?>" >Twitter</a>
        </div>
      </div>
    </div>
  </header>

