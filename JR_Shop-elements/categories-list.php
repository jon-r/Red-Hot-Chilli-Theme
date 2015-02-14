
<?php
 // $safeGroup = jr_validate_group($_GET[g]);
  $filteredCategories = groupFilter($safeArr[group]);
?>

<header class="section-header" >
  <h1><?php echo $safeArr[group] ?></h1>
</header>

<article class="shop-grid category">

  <?php foreach ($filteredCategories as $category) :
    $link = http_build_query(['cat' => $category[Name], 'page_id' => jr_page('cat')]);
    $imgUrl = imgSrcRoot('thumbnails',$category[Name],'jpg');
  ?>

    <div>
      <a href="?<?php echo $link ?>" >
        <?php echo $imgUrl ?>
        <h2><?php echo $category[Name] ?></h2>
      </a>
    </div>

  <?php endforeach ?>

</article>
