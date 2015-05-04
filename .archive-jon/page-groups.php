<?php
/* Template Name: Groups Page
*
* page for grouped categories.
*/
?>


<?php get_header(); ?>

<main class="container">

  <?php the_content(); ?>

  <div>EVERYTHING BELOW THIS LINE IS OLD</div>
  <hr>

  <?php include( "JR_Shop-elements/nav-bar.php"); ?>

  <?php
    if ($safeArr[group] == 'Not Found') {

      include( "JR_Shop-elements/404-filler.php");

    } else {

      include( "JR_Shop-elements/categories-list.php");

    }
    ?>

</main>





<?php get_footer(); ?>
