<?php get_header(); ?>

<main class="container">

  <?php include( 'page-blocks/nav-bar.php') ?>

  <?php echo do_shortcode("[jr-shop id='404-filler']"); ?>

  <?php echo do_shortcode("[jr-shop id='groups-list']"); ?>

</main>

<?php get_footer(); ?>
