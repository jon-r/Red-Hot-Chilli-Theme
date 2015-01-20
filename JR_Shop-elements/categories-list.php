
<?php
  $safeGroup = jr_validate_group($_GET[g]);
  $filteredCategories = groupFilter($safeGroup);
?>

<h1><?php echo $safeGroup ?></h1>
<article>

  <ul>

  <?php foreach ($filteredCategories as $category) :
    $link = http_build_query(['cat' => $category[Name], 'page_id' => 16]);
    $imgUrl = imgSrcRoot('thumbnails',$category[Name],'jpg');
  ?>

    <li>
      <a href="?<?php echo $link ?>&pg=1" >
        <?php echo $imgUrl ?>
        <h2><?php echo $category[Name] ?></h2>
      </a>
    </li>

  <?php endforeach ?>

  </ul>
  </article>
