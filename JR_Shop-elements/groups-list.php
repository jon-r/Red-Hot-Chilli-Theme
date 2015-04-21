<?php /* list of groups on front page */ ?>

<article class="flex-container">

  <header class="article-header flex-1" >
    <h1>Catering Equipment For Sale</h1>
    <a href="<?php echo $link_allItems; ?>">Click here to View All</a>
  </header>

  <?php foreach($groupArray as $grpName => $groupList) :
      $link = site_url('/departments/'.to_slug($grpName));
      $groupHeaderImg = site_url(imgSrcRoot('icons','header-'.strtok($grpName, ' '),'jpg'));
  ?>

  <div class="shop-tile group flex-3">

    <a href="<?php echo $link ?>" >
      <img src="<?php echo $groupHeaderImg ?>" alt="<?php echo $grpName ?>"/>
    </a>

    <ul class="flex-container">
      <?php foreach ($groupList as $category) :
          $link = site_url('/products/'.to_slug($category[Name]));
      ?>
      <li><a href="<?php echo $link ?>" ><?php echo $category[Name] ?></a></li>
      <?php endforeach ?>
    </ul>

  </div>

  <?php endforeach ?>

</article>
