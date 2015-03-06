<?php /* Filtered items list
*
*
*/
?>

<?php
$categoryList = jr_category_filter($safeArr);
$pageNumber = $_GET['pg'] ?: 1;
$itemCountCheckMax = count($categoryList) > $itemCountMax;
$itemCountCheckMin = count($categoryList) <= $itemCountMin;
$splitList = $itemCountCheck ? array_chunk($categoryList, $itemCountMax) : array($categoryList);
$pageCount = count($splitList );


?>

<article class="shop-grid items">

  <header class="article-header">
    <h1><?php echo $safeArr[pgName]; ?></h1>
    <p><?php echo $safeArr[description] ?></p>
    <?php echo $safeArr[imgURL] ?>
  </header>

  <?php foreach ($splitList[$pageNumber  - 1] as $item) :
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

      <img src="<?php echo img_resize($shop_item[imgFirst], 'tile'); ?>" alt="<?php echo $shop_item[name] ?>" >
    </a>

  </div>

  <?php endforeach ?>

  <?php if ($itemCountCheckMin) : ?>
<div>
  <p>No enough form</p>
</div>

<?php endif ?>

</article>

<?php if ($itemCountCheckMax) : ?>

<nav class="nav-paginate" >
  <div>
    <?php if ($pageNumber > 1) : ?>
    <a href="<?php  echo jr_pg_set(1) ?>" ><h4>&laquo;</h4></a>
    <a href="<?php  echo jr_pg_set(minus) ?>" >&lsaquo;</a>
    <?php endif ?>

    <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
    <a <?php echo jr_is_pg($i) ? 'class="active"' : null ?> href="<?php  echo jr_pg_set($i) ?>" ><h4><?php  echo $i ?></h4></a>
    <?php endfor ?>

    <?php if ($pageNumber < $pageCount) : ?>
    <a href="<?php  echo jr_pg_set(plus) ?>" ><h4>&rsaquo;</h4></a>
    <a href="<?php  echo jr_pg_set($pageCount) ?>" ><h4>&raquo;</h4></a>
    <?php endif ?>
  </div>
</nav>

<?php endif ?>


<!--  $fSoon =        $safeArr['soon'];
  $fRecentSold =  $safeArr['sold'];
  $fStainless =   $safeArr['stainless'];-->
