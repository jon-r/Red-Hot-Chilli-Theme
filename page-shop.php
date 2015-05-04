<?php
/* Template Name: Shop Page
 *
 * (Blank Slate Page)
 */
?>

<?php get_header(); ?>

<main class="container">
  <?php include('page-blocks/nav-bar.php') ?>

  <?php
  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post();
      if ($jr_safeArray[rhc] == 'Not Found' || $jr_safeArray[group] == 'Not Found' || $jr_safeArray[cat] == 'Not Found') {
        echo do_shortcode("[jr-shop id='404-filler']");
      } else {
        the_content();
      }

    }
  } else {
    echo do_shortcode("[jr-shop id='404-filler']");
  }
  ?>

</main>

<?php get_footer(); ?>
