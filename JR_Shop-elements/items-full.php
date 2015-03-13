

<?php /* style for the individual items page */ ?>

<?php

if ($safeArr[ss]) {
    $item = jr_item_query($safeArr[rhc], 1);
    $shop_item = jr_shop_compile($item,'ssFull');
  } else {
    $item = jr_item_query($safeArr[rhc]);
    $shop_item = jr_shop_compile($item,'full');
  }
?>

<article class="shop-full" >
  <div>

    <div class="item-images">
      <div class="item-first <?php echo $shop_item[icon]; ?>" >
        <img src="<?php echo img_resize($shop_item[imgFirst], 'tile') ?>">
      </div>

      <?php if (!$safeArr[ss]) : ?>

      <ul class="item-gallery">
        <?php foreach ($shop_item[imgAll] as $galleryImg) : ?>
        <li><img src="<?php echo img_resize($galleryImg, 'thumb') ?>"></li>
        <?php endforeach ?>
      </ul>

      <?php endif ?>

    </div>

    <div class="item-focus" >
      <header class="item-header">
        <h1><?php echo $shop_item[name]; ?></h1><br>
        <h2><?php echo $shop_item[price] ?></h2>
      </header>

      <?php echo $shop_item[desc] ?>
      <?php echo $shop_item[condition] ?>


      <?php if ($shop_item[icon]) : ?>
        <h4><?php echo $shop_item[watt] ?></h4>
      <?php endif ?>

            <?php echo $shop_item[brand] ?>
      <?php echo $shop_item[model] ?>
      <ul class="item-dimensions">
        <li><?php echo $shop_item[hFull] ?></li>
        <li><?php echo $shop_item[wFull] ?></li>
        <li><?php echo $shop_item[dFull] ?></li>
        <li><?php echo $shop_item[extra] ?></li>
      </ul>

    </div>

    <div class="item-sidebar">

      <button>Ask us</button>
      <button>Shopping List (nyi)</button>
      <button>Buy Now (nyi)</button>

      <ul class="feature-list" >
        <li>One Feature</li>
        <li>Two Feature</li>
        <li>Three Feature</li>
        <li>Four Feature</li>
      </ul>
    </div>

  </div>
  <?php var_dump($shop_item) ?>
</article>
