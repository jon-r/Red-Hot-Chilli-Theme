<?php /* list of groups on front page */ ?>

<article>

  <?php foreach($groupsList as $group) :
      $link = http_build_query(['g' => $group, 'page_id' => 24]);
      $categoriesListFiltered = array_filter ($categoriesList, isGroup($group));
    ?>

  <div>

    <a href="?<?php echo $link ?>" >
      <img src="somepic.jpg" alt="<?php echo $group ?>" />
      <h2><?php echo $group ?></h2>
    </a>

    <ul>
      <?php foreach ($categoriesListFiltered as $category) :
          $link = http_build_query(['cat' => $category[Name], 'page_id' => 16]);
      ?>
      <li><a href="?<?php echo $link ?>" ><?php echo $category[Name] ?></a></li>
      <?php endforeach ?>
    </ul>

  </div>

  <?php endforeach ?>

</article>
