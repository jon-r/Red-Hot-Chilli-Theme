<?php /* Filtered items list
*
*
*/

$pageNumber = $_GET['pg'] ?: 1;
$items = jr_items_list_check($safeArr, $pageNumber);
?>

<article class="flex-container">

  <header class="article-header flex-1">
    <h1><?php echo $safeArr[pgName]; ?></h1>
    <p><?php echo $safeArr[description] ?></p>
    <?php echo $safeArr[imgURL] ?>
  </header>

  <?php foreach ($items['list'] as $item) :
    if ($safeArr[pgType] == 'CategorySS' ) {
      $shop_item = jr_shop_compile($item, 'stainless');
    } else {
      $shop_item = jr_shop_compile($item, 'med');
    }; ?>

  <div class="shop-tile btn-icon flex-4 <?php echo trim($shop_item[info].' '.$shop_item[icon]); ?>" >

    <a href="<?php echo site_url($shop_item[webLink]) ?>">

      <div>
        <h3><?php echo $shop_item[name] ?></h3>
      </div>

      <img src="<?php echo site_url(img_resize($shop_item[imgFirst], 'tile')); ?>" alt="<?php echo $shop_item[name] ?>" >

      <div>
        <em><?php echo $shop_item[price] ?></em><br>
        <?php echo $shop_item[rhc] ?>
      </div>

    </a>

  </div>

  <?php endforeach; ?>

      <?php if ($items['paginate']) : ?>

    <nav class="flex-container shop-items-nav">
      <div class="nav-paginate">
        <?php if ($pageNumber > 1) : ?>
        <a href="<?php  echo jr_pg_set(1) ?>"><h4>&laquo;</h4></a>
        <a href="<?php  echo jr_pg_set(minus) ?>"><h4>&lsaquo;</h4></a>
        <?php endif ?>

        <?php for ($i=1 ; $i <= $items['paginate']; $i++) : ?>
        <a <?php echo jr_is_pg($i) ? 'class="active"' : null ?> href="<?php  echo jr_pg_set($i) ?>" ><h4><?php  echo $i ?></h4></a>
        <?php endfor ?>

        <?php if ($pageNumber < $items['paginate']) : ?>
        <a href="<?php  echo jr_pg_set(plus) ?>"><h4>&rsaquo;</h4></a>
        <a href="<?php  echo jr_pg_set($items['paginate']) ?>"><h4>&raquo;</h4></a>
        <?php endif ?>
      </div>
    </nav>

    <?php endif ?>

</article>
