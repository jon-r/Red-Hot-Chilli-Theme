<?php get_header(); ?>



<section class="container">

  <?php include( "JR_Shop-elements/nav-bar.php"); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h2><?php the_title(); ?></h2>
  <article>

  <?php the_content();

foreach ($brandsListFull  as $brand) {
  echo $brand.'<br>';
}

    ?>

  </article>

<?php endwhile; else : ?>
              <h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
      <article id="post-not-found" class="hentry cf">

              <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
                <p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
      </article>

<?php endif; ?>




</section>

<?php get_footer(); ?>
