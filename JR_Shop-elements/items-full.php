

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
  <div class="item-container">

    <div class="item-sidebar">
      <button class="basket-w"><h3>Buy Today</h3></button>
      <button class="question"><h3>Need More Information</h3></button>
      <button class="list"><h3>Add To Shopping List</h3></button>
    </div>

    <div class="item-gallery">
      <div class="item-main <?php echo $shop_item[icon]; ?>" >
        <img src="<?php echo img_resize($shop_item[imgFirst], 'tile') ?>">
      </div>

      <?php if (!$safeArr[ss]) : ?>

      <ul class="item-thumbs">
        <?php foreach ($shop_item[imgAll] as $galleryImg) : ?>
        <li><img src="<?php echo img_resize($galleryImg, 'thumb') ?>"></li>
        <?php endforeach ?>
      </ul>

      <?php endif ?>
    </div>

    <div class="item-info">
      <header class="item-header">
        <h1><?php echo $shop_item[name]; ?></h1>
        <br>
        <h2><?php echo $shop_item[price] ?></h2>
      </header>

      <div class="item-description">
        <?php echo $shop_item[desc] ?>
        <?php echo $shop_item[condition] ?>

        <?php echo $shop_item[brand] ?>
        <?php echo $shop_item[model] ?>
      </div>

      <ul class="item-features">
        <li>Fully Tested &amp; Cleaned</li>
        <li>Competitive UK &amp; EU Delivery Quotes</li>
        <li>Finance Options On Request</li>
        <li>Viewing available at our showroom in Warrington, Cheshire</li>
        <li>Aftercare &amp; Warrantees</li>
        <?php if ($shop_item[icon] == "natural-gas") : ?>
        <li><em>Ask today about conversions to LPG</em></li>
        <?php endif ?>
      </ul>

      <div class="item-specs">

        <ul class="item-dimensions">
          <li><?php echo $shop_item[hFull] ?></li>
          <li><?php echo $shop_item[wFull] ?></li>
          <li><?php echo $shop_item[dFull] ?></li>
          <li><?php echo $shop_item[extra] ?></li>
        </ul>
  <!--
        <aside class="item-3d">
          <?php $box_xyz = jr_box_3d($shop_item[height], $shop_item[width], $shop_item[depth]) ?>
          <div data-value="<?php echo $box_xyz[man] ?>" class="box-floor">
            <div class="box-x" data-value="<?php echo $box_xyz[width] ?>">x width: <?php echo $shop_item[width] ?></div>
            <div class="box-y" data-value="<?php echo $box_xyz[depth] ?>">y depth: <?php echo $shop_item[depth] ?></div>
            <div class="box-z" data-value="<?php echo $box_xyz[height] ?>">z height: <?php echo $shop_item[height] ?></div>
          </div>
        </aside> -->

        <?php if ($shop_item[icon]) : ?>
        <div class="item-power <?php echo $shop_item[icon] ?>">
          <?php echo $shop_item[watt] ?>
        </div>

        <?php endif ?>

      </div>


    </div>



  </div>
  <?php var_dump($shop_item) ?>
</article>
