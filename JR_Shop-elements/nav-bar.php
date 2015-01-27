<?php /* list of groups on menu + custom links */
 /*
  [RHC ICON]          [SEARCH ]           [other links]
_________________________________________________________
[MENU BUTTON]  [ HOME > GROUP > CATEGORY > ITEM ]
                      > SPECIAL PAGE(S)
*/
?>
<nav>

  <div id="js-menuMain" class="menu-main<?php echo is_front_page() ? ' menu-home' : null ?>" >
    <h2 id="js-menuMainBtn">Browse</h2>
    <ul class='menu-main-primary'>
    <?php foreach($groupsList as $group) :
        $link = http_build_query(['g' => $group, 'page_id' => 24]);
        $categoriesListFiltered = array_filter ($categoriesList, isGroup($group));
      ?>

      <li>
        <?php echo $group ?>
        <ul>
          <a href="?<?php echo $link ?>" ><h3><?php echo $group ?></h3></a>

          <?php foreach ($categoriesListFiltered as $category) :
              $link = http_build_query(['cat' => $category[Name], 'page_id' => 16]);
          ?>
          <li><a href="?<?php echo $link ?>" ><?php echo $category[Name] ?></a></li>
          <?php endforeach ?>
        </ul>
      </li>

    <?php endforeach ?>
      <li>Featured
        <ul>
          <a><h3>Featured</h3></a>
          <li><a href="?page_id=16&new=1&pg=1" >NEW Items</a></li>
          <li><a href="?page_id=16&soon=1&pg=1" >Coming Soon</a></li>
          <li><a href="?page_id=16&sold=1&pg=1" >Recently Sold</a></li>
          <li><a href="?page_id=16&all=1&pg=1" >All Items</a></li>
        </ul>
      </li>
      <li>Other Services
        <?php // wp menu starts here. functions.php for setup --> ?>
        <?php dynamic_sidebar( 'sidebar1' ); ?>
      </li>
    </ul>

  </div>

  <?php if ( is_front_page() ): ?>

  <div class="menu-carousel">
      banner here
  </div>

  <?php else: ?>

  <div class="menu-breadcrumbs">
    <?php
      $breadLinks = jr_page_crumbles ($safeArr);
      foreach ($breadLinks as $breadSlices) {
        foreach ($breadSlices as $name => $link) {
          echo $link ? '<a href="'.$link.'" ><h4>'.$name."</h4></a>" : null;
        }
      }
    ?>
  </div>

  <?php endif; ?>

</nav>

