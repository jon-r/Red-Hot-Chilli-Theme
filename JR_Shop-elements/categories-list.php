
<?php
  if ($safeArr[group] == 'all') {
    $filteredCategories = $getCategory;
  } else {
    $filteredCategories = $groupArray[$safeArr[group]];
  }
?>

<article class="flex-container">

  <header class="article-header flex-1" >
    <h1><?php echo $safeArr[pgName] ?></h1>
  </header>

  <?php foreach ($filteredCategories as $category) :
    $link = site_url('/products/'.sanitize_title($category[Name]));
    //http_build_query(['cat' => $category[Name], 'page_id' => jr_page('cat')]);
    $imgUrl = imgSrcRoot('thumbnails',$category[RefName],'jpg');
  ?>

    <div class="shop-tile flex-4">
      <a href="<?php echo $link ?>" >
        <div><h3><?php echo $category[Name] ?></h3></div>
        <img src="<?php echo site_url($imgUrl) ?>" />
      </a>
    </div>

  <?php endforeach ?>

</article>
