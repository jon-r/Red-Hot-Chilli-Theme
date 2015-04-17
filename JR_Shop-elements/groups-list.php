<?php /* list of groups on front page */ ?>

<article class="flex-container">

  <header class="article-header flex-1" >
    <h1>Catering Equipment For Sale</h1>
    <a href="<?php echo $link_allItems; ?>">Click here to View All</a>
  </header>

  <?php foreach($getGroup as $group) :
      $link = http_build_query(['g' => $group, 'page_id' => jr_page('grp')]);
      $categoriesListFiltered = array_filter ($categoriesList, isGroup($group));
      $groupHeaderImg = imgSrcRoot('icons','header-'.strtok($group, ' '),'png');
  ?>

  <div class="shop-tile group flex-3">

    <a href="?<?php echo $link ?>" >
      <img src="<?php echo $groupHeaderImg ?>" alt="<?php echo $group ?>"/>
    </a>

    <ul class="flex-container">
      <?php foreach ($categoriesListFiltered as $category) :
          $link = http_build_query(['cat' => $category[Name], 'page_id' => jr_page('cat')]);
      ?>
      <li><a href="?<?php echo $link ?>" ><?php echo $category[Name] ?></a></li>
      <?php endforeach ?>
    </ul>

  </div>

  <?php endforeach ?>

</article>
