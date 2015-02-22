<?php /* Filtered items list
*
*
*/
?>

<?php
$categoryList = jr_category_filter($safeArr);
$itemNumber = 0;
?>



<article class="shop-grid items">

  <header class="article-header">
    <h1><?php echo $safeArr[pgName] ?></h1>
    <p><?php echo $safeArr[description] ?></p>
    <?php echo $safeArr[imgURL] ?>
  </header>

  <?php foreach ($categoryList as $item) :
    $itemNumber++;
    if ($safeArr[pgType]=='CategorySS' ) {
      $shop_item=jr_shop_compile($item, 'stainless');
    } else {
      $shop_item=jr_shop_compile($item, 'med');
    };
  ?>
  <div>
    <a href="?<?php echo $shop_item[webLink] ?>">
      <h3><?php echo $shop_item[name] ?></h3>
      <?php echo ($itemNumber % $itemCount == 0 ) ? "Counter-".($itemNumber/$itemCount) : null; ?>
      <p>
        <?php echo $shop_item[rhc] ?>
        <br>
        <?php echo $shop_item[price] ?>
      </p>
      <img src="<?php echo img_resize($shop_item[imgFirst], 'tile') ?>">
      <?php echo $shop_item[info] ?>
      <?php if ($shop_item[icon]) : ?>
      <i class="icon-placeholder"><img src="<?php echo $shop_item[icon] ?>" ></i>
      <?php endif ?>
    </a>
  </div>
  <?php endforeach ?>

</article>


<!--  $fSoon =        $safeArr['soon'];
  $fRecentSold =  $safeArr['sold'];
  $fStainless =   $safeArr['stainless'];-->
