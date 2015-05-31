<?php /*
this page is obsolete





<?php get_header(); ?>

<main class="container">
<?php echo do_shortcode("[jr-shop id='nav-bar']"); ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php the_content(); ?>

  <?php endwhile; else : ?>

    <?php include( "JR_Shop-elements/404-filler.php"); ?>

<?php endif; ?>
</main>
<?php get_footer(); ?>

*/ ?>
