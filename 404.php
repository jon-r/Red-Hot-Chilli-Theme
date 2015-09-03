<?php get_header(); ?>

<main class="container">
  <?php include( 'includes/nav-bar.php') ?>

  <?php echo do_shortcode("[jr-shop id='404-filler']"); ?>

  <?php echo do_shortcode("[jr-shop id='categories-list' cached=true]"); ?>

</main>

<?php get_footer(); ?>
