<?php /* Filtered items list
*
*
*/

$pageNumber = $_GET['pg'] ?: 1;
$items = jrx_items_list($safeArr, $pageNumber);

var_dump(jrx_query_debug($safeArr) );

?>

<article class="flex-container">

  <header class="article-header flex-1">
    <h1><?php echo $safeArr[pgName]; ?></h1>
    <p><?php echo $safeArr[description] ?></p>
    <?php echo $safeArr[imgURL] ?>
  </header>

  <?php
  foreach ($items['list'] as $item) {
    include( "list-item.php");
  }
  ?>

</article>

<?php if ($items['paginate']) : ?>

<nav class="flex-container nav-paginate">
  <section>
    <?php if ($pageNumber > 1) : ?>
    <a href="<?php  echo jrx_pg_set(1) ?>"><h4>&laquo;</h4></a>
    <a href="<?php  echo jrx_pg_set(minus) ?>"><h4>&lsaquo;</h4></a>
    <?php endif ?>

    <?php for ($i=1 ; $i <= $items['paginate']; $i++) : ?>
    <a <?php echo jrx_is_pg($i) ? 'class="active"' : null ?> href="<?php  echo jrx_pg_set($i) ?>" ><h4><?php  echo $i ?></h4></a>
    <?php endfor ?>

    <?php if ($pageNumber < $items['paginate']) : ?>
    <a href="<?php  echo jrx_pg_set(plus) ?>"><h4>&rsaquo;</h4></a>
    <a href="<?php  echo jrx_pg_set($items['paginate']) ?>"><h4>&raquo;</h4></a>
    <?php endif ?>
  </section>
</nav>

<?php endif ?>

