<?php /* Filtered items list
*
*
*/
?>

<?php
$categoryList = jr_category_filter($safeArr);
$count = count($categoryList);
$itemCount = $count > 100 ? "(100+ Results)" : "(".$count." Results)";
?>

<header class="section-header">
  <h1><?php echo $safeArr[pgName] ?></h1><h3><?php echo $itemCount ?></h3>
  <div><?php echo $safeArr[description] ?></div><?php echo $safeArr[imgURL] ?>
</header>

<article class="shop-grid item">



  <?php
  foreach ($categoryList as $item) :
//    var_dump($item);
    if ($safeArr[pgType] == 'CategorySS') {
      $shop_item = jr_shop_compile($item,'stainless');
    } else {
      $shop_item = jr_shop_compile($item,'med');
    };
  ?>
  <div>
    <a href="?<?php echo $shop_item[webLink] ?>" >
      <h3><?php echo $shop_item[name] ?></h3>
      <?php echo $shop_item[imgFirst] ?>
      <?php echo $shop_item[info] ?>
      <i class="icon-placeholder"><?php echo $shop_item[icon] ?></i>
      <p>ref: <?php echo $shop_item[rhc] ?></p>
      <?php echo $shop_item[price] ? "<p>£".$shop_item[price]."+ VAT</p>" : null ?>
    </a>
  </div>
<?php endforeach ?>

</article>


<!--  $fSoon =        $safeArr['soon'];
  $fRecentSold =  $safeArr['sold'];
  $fStainless =   $safeArr['stainless'];-->
