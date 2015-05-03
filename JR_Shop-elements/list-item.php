<?php
$shopItem = ( $safeArr[pgType] == 'CategorySS' ) ? jrx_shop_compile($item, 'listSS') : jrx_shop_compile($item, 'list'); ?>

<section class="shop-tile btn-icon flex-4 <?php echo trim($shopItem[info].' '.$shopItem[icon]); ?>">

  <a href="<?php echo site_url($shopItem[webLink]) ?>">

    <div>
      <h3><?php echo $shopItem[name] ?></h3>
    </div>

    <img src="<?php echo site_url(img_resize($shopItem[imgFirst], 'tile')); ?>" alt="<?php echo $shopItem[name] ?>">

    <?php if ($safeArr[pgType]=='CategorySS' ) : ?>
    <span class="ss-length btn-red"><h4>Length: </h4><h2><?php echo $shopItem[width] ?></h2></span>
    <?php endif ?>

    <div>
      <em><?php echo $shopItem[price] ?></em>
      <br>
      <?php echo $shopItem[rhc] ?>
    </div>

  </a>

</section>
