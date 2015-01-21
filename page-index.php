<?php
/* Template Name: Front Page
*
* */
?>

<!-------header---------------------------------------------------------->

<?php get_header(); ?>

<?php include( "JR_Shop-elements/menu-main.php"); ?>


<?php // include( "sidebar-left.php"); ?>
<!--  change from sidebar to topbar. leaving on index page so i dont forget -->

<section class="container">

  <div >
  <?php include( "JR_Shop-elements/carousel.php"); ?>

  <?php include( "JR_Shop-elements/groups-list.php"); ?>

  </div>

</section>

<?php get_footer(); ?>
