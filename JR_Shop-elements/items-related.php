<?php /* Related Items list
*
* just 4 randomly selected items, matching the primary category page
*/

$related = jr_query_related($safeArr);

?>

<article class="flex-container">

  <header class="article-header flex-1">
    <h1>More <?php echo $safeArr[cat]; ?></h1>
  </header>

  <?php foreach ($related as $item) :
    if ($safeArr[pgType] == 'CategorySS' ) {
      $shop_item = jr_shop_compile($item, 'stainless');
    } else {
      $shop_item = jr_shop_compile($item, 'med');
    };
  ?>

  <div class="shop-tile btn-icon flex-4 <?php echo trim($shop_item[info].' '.$shop_item[icon]); ?>" >

    <a href="<?php echo site_url($shop_item[webLink]) ?>">

      <div>
        <h3><?php echo $shop_item[name] ?></h3>
      </div>

      <img src="<?php echo site_url(img_resize($shop_item[imgFirst], 'tile')); ?>" alt="<?php echo $shop_item[name] ?>" >

      <?php if ($shop_item[width]) : ?>
      <span class="ssLength btn-red"><h4>Length: </h4><h2><?php echo $shop_item[width] ?></h2></span>
      <?php endif ?>

      <div>
        <em><?php echo $shop_item[price] ?></em><br>
        <?php echo $shop_item[rhc] ?>
      </div>



    </a>

  </div>

  <?php endforeach; ?>

</article>
