<article class="default-page">
  <div class="item-container flex-container">

    <header class="article-header flex-1">
      <h1><?php echo $safeArr[pgName]; ?></h1>
      <!--      <h2><?php the_title(); ?></h2>-->
      <?php echo $safeArr[imgURL] ?>
    </header>

    <?php the_content(); ?>

  </div>
</article>

