<?php /* Filtered items list
*
*
*/
?>

<?php $safeArr = jr_validate_category_params($_GET); ?>
<?php $categoryList = jr_category_filter($safeArr); ?>

<h1>Title PH</h1>

<article>

  <?php foreach ($categoryList as $item) :
    var_dump($item);
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
