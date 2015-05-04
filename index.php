<?php get_header(); ?>


<main class="container">
<?php echo do_shortcode("[jr-shop id='nav-bar']"); ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php the_content(); ?>

  <?php endwhile; else : ?>

    <?php include( "JR_Shop-elements/404-filler.php"); ?>

<?php endif; ?>

  <div>EVERYTHING BELOW THIS LINE IS OLD</div>
  <hr>

  <?php //include(  "JR_Shop-elements/nav-bar.php"); ?>

  <?php include( "JR_Shop-elements/index-featured.php"); ?>

  <?php include( "JR_Shop-elements/groups-list.php"); ?>

  <?php include( "JR_Shop-elements/contact-bar.php"); ?>

</main>

<?php get_footer(); ?>



