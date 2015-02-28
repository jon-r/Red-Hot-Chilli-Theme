<?php /* Filtered items list
*
*
*/
?>

<?php
$categoryList = jr_category_filter($safeArr);
$itemNumber = $chunkNumber = 0;
$itemsListChunk = array_chunk($categoryList, $itemCount);
?>



<article class="shop-grid items">

  <header class="article-header">
    <h1><?php echo $safeArr[pgName] ?></h1>
    <p><?php echo $safeArr[description] ?></p>
    <?php echo $safeArr[imgURL] ?>
  </header>

  <?php foreach ($itemsListChunk as $listPartial) :
  $chunkNumber++;
  ?>
  <?php foreach ($listPartial as $item) :
    $itemNumber++;
    $loadMarker = ($itemNumber % $itemCount == 0 ) ? 'load-marker' : null;
    if ($safeArr[pgType] == 'CategorySS' ) {
      $shop_item = jr_shop_compile($item, 'stainless');
    } else {
      $shop_item = jr_shop_compile($item, 'med');
    };
  ?>
  <div class="<?php echo trim($shop_item[info].' '.$shop_item[icon].' '.$loadMarker); ?>" >
    <a href="?<?php echo $shop_item[webLink] ?>">
      <h3><?php echo $shop_item[name] ?></h3>

      <p>
        <?php echo $shop_item[rhc] ?>
        <br>
        <?php echo $shop_item[price] ?>
      </p>
      <img src="<?php echo imgSrcRoot('icons',lincat,'jpg'); ?>" data-load="<?php echo img_resize($shop_item[imgFirst], 'tile'); ?>" alt="<?php echo $shop_item[name] ?>" >
    </a>
  </div>
  <?php
    endforeach;
    if ($listPartial != end($itemsListChunk) && count($itemsListChunk) > 1) :
  ?>
  <span class="items-loader"><?php echo "chunk ".$chunkNumber; ?></span>
  <?php
    endif;
    endforeach;
  ?>


</article>


<!--  $fSoon =        $safeArr['soon'];
  $fRecentSold =  $safeArr['sold'];
  $fStainless =   $safeArr['stainless'];-->
