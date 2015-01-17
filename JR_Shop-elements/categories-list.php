
<?php
    $fGroup = jr_validate_keywords($_GET["g"], 'group');
    $filteredCategories = groupFilter($fGroup);
?>

<h1><?php echo $fGroup ?></h1>
<article>

  <ul>

  <?php
      foreach ($filteredCategories as $category) :
        $link = http_build_query(['cat' => $category[Name], 'page_id' => 16]);
        $imgUrl = imgSrcRoot('thumbnails',$category[Name]).".jpg";
  ?>

    <li>
      <a href="?<?php echo $link ?>&pg=1" >
        <img src="<?php echo $imgUrl ?>" />
        <h2><?php echo $category[Name] ?></h2>
      </a>
    </li>

  <?php endforeach ?>

  </ul>
  </article>
