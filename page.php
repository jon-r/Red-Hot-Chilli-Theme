<?php
/*
 *
 * (Blank Slate Page)
 */
?>
<?php get_header(); ?>

<main class="container">
  <?php include( 'includes/nav-bar.php') ?>

  <?php echo do_shortcode( "[jr-shop id='shop-cart']"); ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article class="flex-container default-page">
    <header class="article-header flex-1">
      <h1><?php the_title(); ?></h1>
    </header>

    <?php the_content(); ?>

  </article>

  <?php endwhile; else : ?>
  <?php echo do_shortcode( "[jr-shop id='404-filler']"); ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>



