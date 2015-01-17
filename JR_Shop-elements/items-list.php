<?php /* Filtered items list
*
*
*/
?>

<?php $safeArr = jr_validate_category_params($_GET); ?>

<h1>Title PH</h1>
<article >
  <hr>

      <?php
$categoryList = categoryFilter($safeArr);

foreach ($categoryList as $item) {
  $jrShop = rhcCompile($item,'lite');
  var_dump($jrShop);
}; ?>

</article>
