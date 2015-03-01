<?php /* Filtered items list
*
*
*/
?>

<?php
$categoryList = jr_category_filter($safeArr);
$pageNumber = $_GET['pg'] ?: 1;
$itemCountCheck = count($categoryList) >= $itemCountMax;
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

</article>

<?php if ($itemCountCheck) : ?>

<nav class="nav-paginate" >
  <div>
    <?php if ($pageNumber > 1) : ?>
    <a href="<?php  echo jr_pg_set(1) ?>" >first</a>
    <a href="<?php  echo jr_pg_set(minus) ?>" >prev</a>
    <?php endif ?>

    <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
    <a href="<?php  echo jr_pg_set($i) ?>" ><?php  echo $i ?></a>
    <?php endfor ?>

    <?php if ($pageNumber < $pageCount) : ?>
    <a href="<?php  echo jr_pg_set(plus) ?>" >next</a>
    <a href="<?php  echo jr_pg_set($pageCount) ?>" >last</a>
    <?php endif ?>
  </div>
</nav>

<?php endif ?>


<!--  $fSoon =        $safeArr['soon'];
  $fRecentSold =  $safeArr['sold'];
  $fStainless =   $safeArr['stainless'];-->
