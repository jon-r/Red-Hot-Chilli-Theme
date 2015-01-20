<?php /* style for the individual items page */ ?>
<article>

<?php
  //needs to be x to come after name...?
  $SS = $_GET[x];

  if ($SS) {
    $safeRHC = jr_validate_rhcs($_GET[r]);
    $itemList = jr_item_query($safeRHC, $SS);
    $jrShop = jr_shop_compile($itemList,'ssFull');
  } else {
    $safeRHC = jr_validate_rhc($_GET[r]);
    $itemList = jr_item_query($safeRHC);
    $jrShop = jr_shop_compile($itemList,'full');
  }
  var_dump($jrShop);

echo site_url();
  ?>

</article>
