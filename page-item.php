<?php
/* Template Name: Item Page
*
* detail on single item
*/
?>

<!-------header---------------------------------------------------------->

<?php get_header(); ?>

<main class="container">

  <?php include( "JR_Shop-elements/nav-bar.php"); ?>

  <?php
    if ($safeArr[rhc] == 'Not Found') {

      include( "JR_Shop-elements/404-filler.php");

    } else {

      include( "JR_Shop-elements/items-full.php");

      include( "JR_Shop-elements/contact-bar.php");

      include( "JR_Shop-elements/items-related.php");

    }
  ?>

</main>

<?php get_footer(); ?>
