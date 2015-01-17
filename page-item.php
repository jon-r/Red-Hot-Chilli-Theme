<?php
/* Template Name: Item Page
*
* detail on single item
*/
?>

<!-------header---------------------------------------------------------->

<?php get_header(); ?>

<section id="main">
<!-------banner + nav---------------------------------------------------------->
  <?php include( "sidebar-left.php"); ?>
<!-------content---------------------------------------------------------->

<?php
  $itemList = $wpdb->get_row("SELECT * FROM `networked db` WHERE RHC = $_GET[r]", ARRAY_A);

  echo "<hr>";

  $jrShop = rhcCompile($itemList,'full');

  var_dump($jrShop); ?>
</section>

<?php get_footer(); ?>
