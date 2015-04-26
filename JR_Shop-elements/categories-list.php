
<?php
  if ($safeArr[group] == 'all') {
    $filteredCategories = $getCategory;
  } elseif ($safeArr[group] == 'brand') {
    $filteredCategories = brandsList();
  } else {
    $filteredCategories = $groupArray[$safeArr[group]];
  }
?>

<article class="flex-container">

  <header class="article-header flex-1" >
    <h1><?php echo $safeArr[pgName] ?></h1>
  </header>

  <?php foreach ($filteredCategories as $category) :
    if ($safeArr[group] == 'brand') {
      $link = site_url('/brand/'.sanitize_title($category[Name]));
      $imgUrl = imgSrcRoot('brand-squares',$category[RefName],'jpg');
    } else {
      $link = site_url('/products/'.sanitize_title($category[Name]));
      $imgUrl = imgSrcRoot('thumbnails',$category[RefName],'jpg');
    }
  ?>

    <div class="shop-tile flex-4">
      <a href="<?php echo $link ?>" >
        <div><h3><?php echo $category[Name] ?></h3></div>
        <img src="<?php echo site_url($imgUrl) ?>" />
      </a>
    </div>

  <?php endforeach ?>

</article>
