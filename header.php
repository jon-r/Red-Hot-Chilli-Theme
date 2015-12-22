<!doctype html>

<html <?php language_attributes(); ?> ng-app="redHotChilli">

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
  <link rel="manifest" href="<?php echo site_url('manifest.json') ?>" >
  <link rel="shortcut icon" href="<?php echo site_url('favicon.ico') ?>" >
  <meta name="msapplication-TileColor" content="#2b5797">
  <meta name="msapplication-TileImage" content="<?php echo site_url('images/favicon/mstile-144x144.png') ?>" >
  <meta name="msapplication-config" content="<?php echo site_url('browserconfig.xml') ?>" >
  <meta name="theme-color" content="#931919">

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php // wordpress head functions ?>
  <?php wp_head(); ?>
  <?php // end of wordpress head ?>


</head>

<body ng-controller="masterCtrl">

    <?php //Google Analytics ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-39066538-7', 'auto');
      ga('send', 'pageview');

    </script>
  <?php // end analytics ?>
  <?php //moves menu to a fixed position on the front page, without double cache ?>
  <script type="text/javascript" > var isIndex = <?php echo is_front_page() ? 'true' : 'false'; ?></script>

  <header class="primary-header" role="banner">

    <?php include('includes/header-bar.php'); ?>

  </header>

