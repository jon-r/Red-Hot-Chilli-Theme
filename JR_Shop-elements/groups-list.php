<?php /* list of groups on front page */ ?>

<article class="shop-grid group">

  <?php foreach($groupsList as $group) :
      $link = http_build_query(['g' => $group, 'page_id' => jr_page('grp')]);
      $categoriesListFiltered = array_filter ($categoriesList, isGroup($group));
    ?>

  <div>

    <a href="?<?php echo $link ?>" >
      <img src="somepic.jpg" />
      <h3><?php echo $group ?></h3>
    </a>

    <ul>
      <?php foreach ($categoriesListFiltered as $category) :
          $link = http_build_query(['cat' => $category[Name], 'page_id' => jr_page('cat')]);
      ?>
      <li><a href="?<?php echo $link ?>" ><?php echo $category[Name] ?></a></li>
      <?php endforeach ?>
    </ul>

  </div>

  <?php endforeach ?>

</article>
