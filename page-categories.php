<?php
/* Template Name: Categories Page
*
* Listing all items sorted by Filter
*/
?>

<?php get_header(); ?>



<main class="container">

  <?php the_content(); ?>

  <div>EVERYTHING BELOW THIS LINE IS OLD</div>
  <hr>

  <?php include( "JR_Shop-elements/nav-bar.php"); ?>

  <?php
    if ($safeArr[cat] == 'Not Found') {

      include( "JR_Shop-elements/404-filler.php");

    } else {

      include( "JR_Shop-elements/items-list.php");

      include( "JR_Shop-elements/contact-bar.php");
    }
   ?>

</main>

<?php get_footer(); ?>
