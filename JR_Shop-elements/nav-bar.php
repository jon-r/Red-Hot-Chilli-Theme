<div class="container" >



<?php /* list of groups on menu + custom links */ ?>

  <nav class="menu-main" >
    <h2>Our Store</h2>
    <ul >
    <?php foreach($groupsList as $group) :
        $link = http_build_query(['g' => $group, 'page_id' => 24]);
        $categoriesListFiltered = array_filter ($categoriesList, isGroup($group));
      ?>

      <li>
        <a href="?<?php echo $link ?>" ><?php echo $group ?></a>

        <ul class="menu-main-categories">
          <?php foreach ($categoriesListFiltered as $category) :
              $link = http_build_query(['cat' => $category[Name], 'page_id' => 16]);
          ?>
          <li><a href="?<?php echo $link ?>" ><?php echo $category[Name] ?></a></li>
          <?php endforeach ?>
        </ul>
      </li>

    <?php endforeach ?>

      <li><a href="?page_id=16&new=1&pg=1" >NEW Items</a></li>
      <li><a href="?page_id=16&soon=1&pg=1" >Coming Soon</a></li>
      <li><a href="?page_id=16&sold=1&pg=1" >Recently Sold</a></li>
      <li><a href="?page_id=16&all=1&pg=1" >All Items</a></li>
    </ul>
      <?php // wp menu starts here. functions.php for setup --> ?>
      <?php dynamic_sidebar( 'sidebar1' ); ?>
  </nav>


<?php $breadLinks = jr_page_crumbles ($_GET['page_id'],$safeArr); ?>

  <div class="bread">
    <?php
    foreach ($breadLinks as $name => $link) {
      echo ' > <a href="'.$link.'" >'.$name."</a>";
    }
    ?>
  </div>

</div>
