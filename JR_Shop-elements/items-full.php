<?php /* style for the individual items page */ ?>
<article>

<?php
  $itemList = $wpdb->get_row("SELECT * FROM `networked db` WHERE RHC = $_GET[r]", ARRAY_A);

  $jrShop = jr_shop_compile($itemList,'full');

  var_dump($jrShop); ?>

</article>
