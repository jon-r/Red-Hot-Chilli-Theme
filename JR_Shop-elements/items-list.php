<?php /* Filtered items list
*
*
*/
?>

<?php

$pageNumber = $_GET['pg'] ?: 1;
$categoryList = jr_category_filter($safeArr, $pageNumber);

$itemCountAll = jr_cat_count($safeArr);

$itemCountCheckMax = $itemCountAll > $itemCountMax;
$itemCountCheckMin = count($categoryList) <= $itemCountMin;
//$splitList = $itemCountCheckMax ? array_chunk($categoryList, $itemCountMax) : array($categoryList);
$pageCount = intval(ceil($itemCountAll / $itemCountMax));
if (!$itemCountCheckMax) {
    $itemsOnPage = $itemCountAll % $itemCountMax;
    $categorySold = jr_cat_sold($safeArr, $itemsOnPage);
} else {
  $categorySold = [];
}
$categoryListExtended = array_Merge($categoryList, $categorySold);
?>

<article class="shop-grid items">

  <header class="page-header">
    <h1><?php echo $safeArr[pgName]; ?></h1>
    <p><?php echo $safeArr[description] ?></p>
    <?php echo $safeArr[imgURL] ?>
  </header>

  <?php foreach ($categoryListExtended as $item) :
    if ($safeArr[pgType] == 'CategorySS' ) {
      $shop_item = jr_shop_compile($item, 'stainless');
    } else {
      $shop_item = jr_shop_compile($item, 'med');
    }; ?>

  <div class="shop-tile <?php echo trim($shop_item[info].' '.$shop_item[icon]); ?>" >

    <a href="?<?php echo $shop_item[webLink] ?>">

      <div>
        <h3><?php echo $shop_item[name] ?></h3>
      </div>

      <img src="<?php echo img_resize($shop_item[imgFirst], 'tile'); ?>" alt="<?php echo $shop_item[name] ?>" >

      <div>
        <em><?php echo $shop_item[price] ?></em><br>
        <?php echo $shop_item[rhc] ?>
      </div>

    </a>

  </div>

  <?php endforeach;?>

</article>

  <footer class="page-footer">
    <?php if ($itemCountCheckMin) : ?>
    <div class="shop-items-contact">
      <h2>Still not found what you are looking for?</h2>
      <p>Contact us today</p>
      <form class="shop-items-form">
        <input type="text" name="name" >
        <label for="Name" >Name</label>
        <input type="email" name="email" >
        <label for="email" >Email Address</label>
        <input type="number" name="phone" >
        <label for="phone" >Phone Number</label>
        <input type="text" name="subject" >
        <label for="subject" >Subject</label>
      </form>
    </div>

    <?php endif ?>
    <?php if ($itemCountCheckMax) : ?>

    <nav class="shop-items-nav">
      <div class="nav-paginate">
        <?php if ($pageNumber > 1) : ?>
        <a href="<?php  echo jr_pg_set(1) ?>"><h4>&laquo;</h4></a>
        <a href="<?php  echo jr_pg_set(minus) ?>"><h4>&lsaquo;</h4></a>
        <?php endif ?>

        <?php for ($i=1 ; $i <= $pageCount; $i++) : ?>
        <a <?php echo jr_is_pg($i) ? 'class="active"' : null ?> href="<?php  echo jr_pg_set($i) ?>" ><h4><?php  echo $i ?></h4></a>
        <?php endfor ?>

        <?php if ($pageNumber < $pageCount) : ?>
        <a href="<?php  echo jr_pg_set(plus) ?>"><h4>&rsaquo;</h4></a>
        <a href="<?php  echo jr_pg_set($pageCount) ?>"><h4>&raquo;</h4></a>
        <?php endif ?>
      </div>
    </nav>

    <?php endif ?>


  </footer>



<!--  $fSoon =        $safeArr['soon'];
  $fRecentSold =  $safeArr['sold'];
  $fStainless =   $safeArr['stainless'];-->
