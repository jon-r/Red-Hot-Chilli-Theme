<?php /* style for the individual items page */ ?>
<article>

<?php
  $safe = jr_validate_item_params($_GET);
  if ($safe[ss]) {
    $itemList = jr_item_query($safe[rhc], 1);
    $jrShop = jr_shop_compile($itemList,'ssFull');
  } else {
    $itemList = jr_item_query($safe[rhc]);
    $jrShop = jr_shop_compile($itemList,'full');
  }

  var_dump($jrShop);


  ?>

</article>
