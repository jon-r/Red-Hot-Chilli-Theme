<!doctype html>

<?php if (is_front_page()) { include('page-blocks/cache-top.php'); } ?>

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

  <?php // copyright and page info ?>
  <meta content="Red Hot Chilli Northwest Ltd (c) <?php echo date('Y') ?>" name="copyright">
  <meta content="Jonathan Richards - github.com/jon-r (c) <?php echo date('Y') ?>" name="author">
  <meta content="Buying and selling used commercial items in the northwest. Purchasers and suppliers of second hand catering equipment." name="description">

  <?php // many many favicons. courtesy http://realfavicongenerator.net ?>
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo site_url('images/favicon/apple-touch-icon-57x57.png') ?>" >
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo site_url('images/favicon/apple-touch-icon-60x60.png') ?>" >
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo site_url('images/favicon/apple-touch-icon-72x72.png') ?>" >
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo site_url('images/favicon/apple-touch-icon-76x76.png') ?>" >
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo site_url('images/favicon/apple-touch-icon-114x114.png') ?>" >
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo site_url('images/favicon/apple-touch-icon-120x120.png') ?>" >
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo site_url('images/favicon/apple-touch-icon-144x144.png') ?>" >
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo site_url('images/favicon/apple-touch-icon-152x152.png') ?>" >
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo site_url('images/favicon/apple-touch-icon-180x180.png') ?>" >
  <link rel="icon" type="image/png" href="<?php echo site_url('images/favicon/favicon-32x32.png" sizes="32x32') ?>" >
  <link rel="icon" type="image/png" href="<?php echo site_url('images/favicon/favicon-194x194.png" sizes="194x194') ?>" >
  <link rel="icon" type="image/png" href="<?php echo site_url('images/favicon/favicon-96x96.png" sizes="96x96') ?>" >
  <link rel="icon" type="image/png" href="<?php echo site_url('images/favicon/android-chrome-192x192.png" sizes="192x192') ?>" >
  <link rel="icon" type="image/png" href="<?php echo site_url('images/favicon/favicon-16x16.png" sizes="16x16') ?>" >
  <link rel="manifest" href="<?php echo site_url('images/favicon/manifest.json') ?>" >
  <link rel="shortcut icon" href="<?php echo site_url('images/favicon/favicon.ico') ?>" >
  <meta name="msapplication-TileColor" content="#2b5797">
  <meta name="msapplication-TileImage" content="<?php echo site_url('images/favicon/mstile-144x144.png') ?>" >
  <meta name="msapplication-config" content="<?php echo site_url('images/favicon/browserconfig.xml') ?>" >
  <meta name="theme-color" content="#931919">

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php // wordpress head functions ?>
  <?php wp_head(); ?>
  <?php // end of wordpress head ?>

  <?php // drop Google Analytics Here ?>
  <?php // end analytics ?>

</head>

<body>

  <header class="primary-header" role="banner">

    <?php include('page-blocks/header-bar.php') ?>

  </header>

