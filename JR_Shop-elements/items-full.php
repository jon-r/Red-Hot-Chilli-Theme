

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

  <div class="item-images" >

    <img src="<?php echo img_resize($shop_item[imgFirst], 'tile') ?>" >
    <?php echo $shop_item[info] ?>

    <ul class="item-gallery" >
    <?php foreach ($shop_item[imgAll] as $galleryImg) : ?>

      <li><img src="<?php echo img_resize($galleryImg, 'thumb') ?>" ></li>
    <?php endforeach ?>
    </ul>

  </div>

  <div class="item-description" >
    <h1><?php echo $shop_item[name]; ?></h1>
    <h3><?php echo $shop_item[rhc] ?></h3>
    <h4><?php echo $shop_item[price] ?></h4>

    <?php echo $shop_item[desc] ?>
    <?php echo $shop_item[condition] ?>


    <div class="item-dimensions">
      <?php echo $shop_item[hFull] ?>
      <?php echo $shop_item[wFull] ?>
      <?php echo $shop_item[dFull] ?>
      <?php echo $shop_item[extra] ?>
    </div>
    <?php if ($shop_item[icon]) : ?>
    <div class="item-power">
      <i class="icon-placeholder"><img src="<?php echo $shop_item[icon] ?>" ></i>
      <h4><?php echo $shop_item[watt] ?></h4>
    </div>
    <?php endif ?>


  </div>
  <div class="item-sidebar">
    <h4><?php echo $shop_item[quantity] ?></h4>
    <button>Ask us</button>
    <button>Shopping List (nyi)</button>
    <button>Buy Now (nyi)</button>
    <?php echo $shop_item[brand] ?>
    <?php echo $shop_item[model] ?>



  </div>

  <?php

  var_dump($shop_item);


  ?>

</article>
