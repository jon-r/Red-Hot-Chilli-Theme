<?php /* Filtered items list
*
*
*/
?>

<?php $safeArr = jr_validate_category_params($_GET); ?>
<?php $categoryList = jr_category_filter($safeArr); ?>

<h1>Title PH</h1>
<article>
  <hr>
  <?php foreach ($categoryList as $item) :
    if ($safeArr['stainless']) {
      //var_dump($item);
      $shop_item = jr_shop_compile($item,'stainless');
      $img_overlay_text = $shop_item[feet]."ft";
    } elseif ($safeArr['soon'] || $safeArr['sold']) {
      $shop_item = jr_shop_compile($item,'min');
      $img_overlay_text = $shop_item[soon] ? "Coming Soon" : null;
      $img_overlay_text = $shop_item[sold] ? "Sold" : null;
    } else {
      $shop_item = jr_shop_compile($item,'med');
      $img_overlay_info = $shop_item[sale] ? "Sale" : null;
    };
    if ($shop_item[power]) {
      $img_overlay_icon = $shop_item[power];
    } elseif ($shop_item[fridge]) {
      $img_overlay_icon = $shop_item[fridge];
    } elseif ($shop_item[freezer]) {
      $img_overlay_icon = $shop_item[freezer];
    } else {
      $img_overlay_icon = null;
    };
  ?>

  <a href="?<?php echo $shop_item[webLink] ?>" >
    <h3><?php echo $shop_item[name] ?></h3>
    <?php echo $shop_item[imgFirst] ?>
    <?php echo $img_overlay_text ?>
    <?php echo $img_overlay_icon ?>
    <p>ref: <?php echo $shop_item[rhc] ?></p>
    <p><?php echo $shop_item[price] ? "£".$shop_item[price]."+ VAT" : null ?></p>
  </a>
<?php endforeach ?>

</article>


<!--  $fSoon =        $safeArr['soon'];
  $fRecentSold =  $safeArr['sold'];
  $fStainless =   $safeArr['stainless'];-->
