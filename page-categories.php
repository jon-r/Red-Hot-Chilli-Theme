<?php
/* Template Name: Filtered Items Page
*
* Listing all items sorted by Filter
*/
?>

<!-------header---------------------------------------------------------->
<?php get_header(); ?>

<section >
<!-------banner + nav---------------------------------------------------------->

<!-------content---------------------------------------------------------->
  <article >
    <h1>Title PH</h1>
    <a href="?page_id=16&new=1&pg=1" >NEW Items</a> <a href="?page_id=16&soon=1&pg=1" >Coming Soon</a><br>
    <a href="?page_id=16&sold=1&pg=1" >Recently Sold</a> <a href="?page_id=16&all=1&pg=1" >All Items</a>
    <hr>

      <?php

$categoryList =
  categoryFilter(
    $fLatest =    $_GET["new"],
    $fAll =       $_GET["all"],
    $fSoon =      $_GET["soon"],
    $fRecentSold = $_GET["sold"],
    $rawSearch =  $_GET["search"],
    $rawBrand =   $_GET["brand"],
    $rawCategory = $_GET["cat"]
  );

foreach ($categoryList as $item) {
  $jrShop = rhcCompile($item,'lite');
  var_dump($jrShop);
}; ?>

  </article>

</section>

<?php get_footer(); ?>
