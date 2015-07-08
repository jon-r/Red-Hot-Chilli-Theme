<?php get_header(); ?>

<main class="container">
  <?php include( 'includes/nav-bar.php') ?>

  <h4><em>The legit 404 page</em></h4>

  <?php echo do_shortcode("[jr-shop id='404-filler']"); ?>

  <?php echo do_shortcode("[jr-shop id='groups-list']"); ?>

</main>

<?php get_footer(); ?>
