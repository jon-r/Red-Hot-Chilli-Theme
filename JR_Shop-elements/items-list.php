<?php /* Filtered items list
*
*
*/
?>

<?php
$categoryList = jr_category_filter($safeArr);
$itemCount = count($categoryList);
$header = jr_category_header( $safeArr , $itemCount);
?>

  <header>
    <h1><?php echo $header[title1] ?></h1><h2><?php echo $header[title2] ?></h2>
    <div><?php echo $header[description] ?></div><?php echo $header[imgURL] ?>
  </header>

<article>

  <?php
  foreach ($categoryList as $item) :
   // var_dump($item);
    if ($safeArr['stainless']) {
      $shop_item = jr_shop_compile($item,'stainless');
    } else {
      $shop_item = jr_shop_compile($item,'med');
    };
  ?>

  <a href="?<?php echo $shop_item[webLink] ?>" >
    <h3><?php echo $shop_item[name] ?></h3>
    <?php echo $shop_item[imgFirst] ?>
    <?php echo $shop_item[info] ?>
    <?php echo $shop_item[icon] ?>
    <p>ref: <?php echo $shop_item[rhc] ?></p>
    <?php echo $shop_item[price] ? "<p>£".$shop_item[price]."+ VAT</p>" : null ?>
  </a>
<?php endforeach ?>

</article>


<!--  $fSoon =        $safeArr['soon'];
  $fRecentSold =  $safeArr['sold'];
  $fStainless =   $safeArr['stainless'];-->
