<?php /* list of groups on menu + custom links */
 /*
  [RHC ICON]          [SEARCH ]           [other links]
_________________________________________________________
[MENU BUTTON]  [ HOME > GROUP > CATEGORY > ITEM ]
                      > SPECIAL PAGE(S)
*/
?>
<nav class="primary-nav">

  <div id="js-menuMain" class="nav-main<?php echo is_front_page() ? ' home' : null ?>" >
    <h2 id="js-menuMainBtn">Browse</h2>
    <ul>
    <?php foreach($groupsList as $group) :
        $link = http_build_query(['g' => $group, 'page_id' => jr_page('grp')]);
        $categoriesListFiltered = array_filter ($categoriesList, isGroup($group));
      ?>

      <li><h4><?php echo $group ?></h4>
        <ul>

          <?php foreach ($categoriesListFiltered as $category) :
              $link = http_build_query(['cat' => $category[Name], 'page_id' => jr_page('cat')]);
          ?>
          <li ><a href="?<?php echo $link ?>" ><?php echo $category[Name] ?></a></li>
          <?php endforeach ?>
        </ul>
      </li>

    <?php endforeach ?>
<?php // wp menus start here. admin for setup --> ?>
      <li><h4>Featured</h4>
        <?php wp_nav_menu(array(
          'container' => '',                           // remove nav container
          'menu' => __( 'Featured Menu Links', 'bonestheme' ),  // nav name
          'menu_class' => '',                          // adding custom nav class
          'theme_location' => 'featured-menu',         // where it's located in the theme
          'fallback_cb' => ''                          // fallback function (if there is one)
        )); ?>
      </li>
      <li><h4>Other Services</h4>
        <?php wp_nav_menu(array(
          'container' => '',                           // remove nav container
          'menu' => __( 'Services Menu links', 'bonestheme' ),  // nav name
          'menu_class' => '',                          // adding custom nav class
          'theme_location' => 'services-menu',         // where it's located in the theme
          'fallback_cb' => ''                          // fallback function (if there is one)
        )); ?>
      </li>
    </ul>

  </div>

  <?php if ( is_front_page() ): ?>

  <div class="carousel">
      banner here
  </div>

  <?php else: ?>

  <div class="nav-breadcrumbs">
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

