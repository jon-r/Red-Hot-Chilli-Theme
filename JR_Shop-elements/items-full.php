

<?php /* style for the individual items page */ ?>

<?php
echo $safeArr[name] ;
if ($safeArr[ss]) {
    $itemList = jr_item_query($safeArr[rhc], 1);
    $jrShop = jr_shop_compile($itemList,'ssFull');
  } else {
    $itemList = jr_item_query($safeArr[rhc]);
    $jrShop = jr_shop_compile($itemList,'full');
  }
?>

<article>

<?php

  var_dump($jrShop);


  ?>

</article>
