<?php get_header(); ?>

<main class="container">
  <?php include( 'page-blocks/nav-bar.php') ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article class="default-page flex-container">

    <section class=" flex-1">
    <header class="article-header">
      <h1><?php the_title(); ?></h1>
    </header>

      <?php the_content(); ?>

    </section>
  </article>

  <?php endwhile; else : ?>
  <?php echo do_shortcode( "[jr-shop id='404-filler']"); ?>
  <?php endif; ?>



</main>

<?php get_footer(); ?>



