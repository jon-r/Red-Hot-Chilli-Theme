

<?php /* style for the individual items page */ ?>

<?php

if ($safeArr[ss]) {
    $itemList = jr_item_query($safeArr[rhc], 1);
    $jrShop = jr_shop_compile($itemList,'ssFull');
  } else {
    $itemList = jr_item_query($safeArr[rhc]);
    $jrShop = jr_shop_compile($itemList,'full');
  }
?>

<header class="section-header">
  <h1><?php echo $safeArr[pgName]; ?></h1>
  <h3>Ref: RHC<?php echo $safeArr[rhc] ?></h3>
</header>
<article>

<?php

  var_dump($jrShop);


  ?>

</article>
