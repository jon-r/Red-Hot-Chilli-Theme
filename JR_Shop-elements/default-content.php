  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>


  <article class="default-page">

    <header class="article-header">
      <h1><?php echo $safeArr[pgName]; ?></h1>
<!--      <h2><?php the_title(); ?></h2>-->
      <?php echo $safeArr[imgURL] ?>
    </header>

    <?php the_content(); ?>

  </article>

  <?php endwhile; else : ?>

  <h2><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h2>

  <article id="post-not-found" class="hentry cf">

    <p>
      <?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?>
    </p>

    <p>
      <?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?>
    </p>

  </article>

  <?php endif; ?>
