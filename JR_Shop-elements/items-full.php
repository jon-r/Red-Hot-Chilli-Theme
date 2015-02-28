

<?php /* style for the individual items page */ ?>

<?php

if ($safeArr[ss]) {
    $itemList = jr_item_query($safeArr[rhc], 1);
    $shop_item = jr_shop_compile($itemList,'ssFull');
  } else {
    $itemList = jr_item_query($safeArr[rhc]);
    $shop_item = jr_shop_compile($itemList,'full');
  }
?>

<article class="shop-grid single" >

  <header class="article-header">
    <h1><?php echo $shop_item[name]; ?></h1><br>
    <h3><?php echo $shop_item[rhc] ?></h3>
  </header>

  <div class="item-sidebar">
    <h2><?php echo $shop_item[price] ?></h2><br>
    <h4><?php echo $shop_item[quantity] ?></h4>
    <button>Ask us</button>
    <button>Shopping List (nyi)</button>
    <button>Buy Now (nyi)</button>
    <?php echo $shop_item[brand] ?>
    <?php echo $shop_item[model] ?>
    <ul class="item-dimensions">
      <li><?php echo $shop_item[hFull] ?></li>
      <li><?php echo $shop_item[wFull] ?></li>
      <li><?php echo $shop_item[dFull] ?></li>
      <li><?php echo $shop_item[extra] ?></li>
    </ul>

  </div>

  <div class="item-focus" >

    <img src="<?php echo img_resize($shop_item[imgFirst], 'tile') ?>" >
    <?php echo $shop_item[info] ?>


    <?php echo $shop_item[desc] ?>
    <?php echo $shop_item[condition] ?>


    <?php if ($shop_item[icon]) : ?>
    <div class="item-power">
      <i class="icon-placeholder"><img src="<?php echo $shop_item[icon] ?>" ></i>
      <h4><?php echo $shop_item[watt] ?></h4>
    </div>
    <?php endif ?>


  </div>

  <div class="item-images" >

    <?php foreach ($shop_item[imgAll] as $galleryImg) : ?>

      <img src="<?php echo img_resize($galleryImg, 'thumb') ?>" >
    <?php endforeach ?>

  </div>
  <?php var_dump($shop_item) ?>
</article>
