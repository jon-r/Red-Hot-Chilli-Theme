<?php
/* Template Name: Front Page
*
* */
?>

<!-------header---------------------------------------------------------->

<?php get_header(); ?>

<?php include( "sidebar-left.php"); ?>
<!--  change from sidebar to topbar. leaving on index page so i dont forget -->

<section>

  <?php include( "JR_Shop-elements/carousel.php"); ?>

  <?php include( "JR_Shop-elements/groups-list.php"); ?>


</section>

<?php get_footer(); ?>
