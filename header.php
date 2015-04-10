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

    <div class="container flex-container<?php echo is_front_page() ? ' home' : ' not-home' ?>" >

      <a class="header-logo flex-<?php echo is_front_page() ? '1' : '2' ?>" href="<?php echo home_url(); ?>" rel="nofollow">
        <img src="<?php echo imgSrcRoot('rhc','RHC-Web','png'); ?>" alt="Red Hot Chilli - Used Catering Equipment"/>
      </a>

      <menu class="header-links flex-<?php echo is_front_page() ? '1' : '2' ?> flex-container">
        <form class="form-head-search flex-<?php echo is_front_page() ? '2' : '1' ?>" >
          <h3 class="head-title">Search Catering Equipment</h3>
          <label class="text-icon search"></label>
          <input type="hidden" name="page_id" value="<?php echo jr_page('srch') ?>">
          <input type="search" name="search" placeholder="Enter Keyword, or RHC Number">
          <button class="btn-red" type="submit"><h3>Go</h3></button>
        </form>
        <div class="header-contact flex-<?php echo is_front_page() ? '2' : '1' ?>" >
          <h3 class="head-title">Talk to us Direct</h3>
          <h3 class="text-icon phone-w" ><?php echo $rhcTel ?></h3>
          <a href="mailto:<?php echo $rhcEmail ?>" ><h3 class="text-icon email-w"><?php echo $rhcEmail ?></h3></a>
        </div>
      </menu>

    </div>
  </header>

