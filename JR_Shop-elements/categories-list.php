
<?php
 // $safeGroup = jr_validate_group($_GET[g]);
  $filteredCategories = groupFilter($safeArr[group]);
?>

<article class="shop-grid category">

  <header class="article-header" >
    <h1><?php echo $safeArr[group] ?></h1>
  </header>

  <?php foreach ($filteredCategories as $category) :
    $link = http_build_query(['cat' => $category[Name], 'page_id' => jr_page('cat')]);
    $imgUrl = imgSrcRoot('thumbnails',$category[RefName],'jpg');
  ?>

    <div>
      <a href="?<?php echo $link ?>" >
        <h3><?php echo $category[Name] ?></h3>
        <img src="<?php echo $imgUrl ?>" >
      </a>
    </div>

  <?php endforeach ?>

</article>
