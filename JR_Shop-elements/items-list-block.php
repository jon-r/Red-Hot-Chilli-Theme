<?php foreach ($itemsListChunk[$chunkNumber] as $item) :
  if ($safeArr[pgType] == 'CategorySS' ) {
    $shop_item = jr_shop_compile($item, 'stainless');
  } else {
    $shop_item = jr_shop_compile($item, 'med');
  }; ?>

<div class="<?php echo trim($shop_item[info].' '.$shop_item[icon]); ?>" >

  <a href="?<?php echo $shop_item[webLink] ?>">

    <h3><?php echo $shop_item[name] ?></h3>

    <p>
      <?php echo $shop_item[rhc] ?>
      <br>
      <?php echo $shop_item[price] ?>
    </p>

    <img src="<?php echo imgSrcRoot('icons','1px','gif'); ?>"
         data-load="<?php echo img_resize($shop_item[imgFirst], 'tile'); ?>"
         alt="<?php echo $shop_item[name] ?>"
         >
  </a>

</div>

<?php endforeach ?>

