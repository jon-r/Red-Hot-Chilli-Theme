<?php /* Filtered items list
*
*
*/
?>

<?php $safeArr = jr_validate_category_params($_GET); ?>
<?php $categoryList = jr_category_filter($safeArr); ?>

<h1>Title PH</h1>
<article >
  <hr>

      <?php
//debug var_dump
//var_dump($categoryList);
foreach ($categoryList as $item) {
  if ($safeArr['stainless']) {
    //var_dump($item);
    $jr_shop = jr_shop_compile($item,'stainless');
  } elseif ($safeArr['soon'] || $safeArr['sold']) {
    $jr_shop = jr_shop_compile($item,'min');
  } else {
    $jr_shop = jr_shop_compile($item,'med');
  };

  var_dump($jr_shop);
};
  ?>

</article>


<!--  $fSoon =        $safeArr['soon'];
  $fRecentSold =  $safeArr['sold'];
  $fStainless =   $safeArr['stainless'];-->
