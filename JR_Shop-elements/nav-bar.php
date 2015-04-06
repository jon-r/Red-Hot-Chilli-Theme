<?php /* list of groups on menu + custom links */
 /*
  [RHC ICON]          [SEARCH ]           [other links]
_________________________________________________________
[MENU BUTTON]  [ HOME > GROUP > CATEGORY > ITEM ]
                      > SPECIAL PAGE(S)
*/
?>
<nav class="flex-container primary-nav">
  <input type="checkbox"  id="menu-toggle">
  <menu class="nav-menu<?php echo is_front_page() ? ' home' : ' not-home' ?>" >

    <label class="menu-btn btn-red" for="menu-toggle">
      <h3 class="text-icon menu-w">Shop</h3>
    </label>

    <ul id="js-main-list" >
    <?php foreach($groupsList as $group) :
        $link = http_build_query(['g' => $group, 'page_id' => jr_page('grp')]);
        $categoriesListFiltered = array_filter ($categoriesList, isGroup($group));
      ?>

      <li><?php echo $group ?>
        <ul>
          <h3 class="touch-toggle btn-red text-icon close-w">Back</h3>
          <?php foreach ($categoriesListFiltered as $category) :
              $link = http_build_query(['cat' => $category[Name], 'page_id' => jr_page('cat')]);
          ?>
          <li ><a class="text-icon arrow-r" href="?<?php echo $link ?>" ><?php echo $category[Name] ?></a></li>
          <?php endforeach ?>
        </ul>

      </li>

    <?php endforeach ?>
<?php // wp menus start here. admin for setup --> ?>
      <li>Featured
        <?php wp_nav_menu(array(
            'container' => '',                           // remove nav container
            'menu' => __( 'Featured Menu Links', 'bonestheme' ),  // nav name
            'menu_class' => '',                          // adding custom nav class
            'before' => '<span class="text-icon arrow-r">',
            'after' => '</span>',
            'items_wrap'      => '<ul><h3 class="touch-toggle btn-red text-icon close-w">Back</h3>%3$s</ul>',
            'theme_location' => 'featured-menu',         // where it's located in the theme
            'fallback_cb' => ''                          // fallback function (if there is one)
        )); ?>
      </li>
      <li>Other Services
        <?php wp_nav_menu(array(
            'container' => '',
            'menu' => __( 'Services Menu links', 'bonestheme' ),  // nav name
            'menu_class' => '',                         // adding custom nav class
            'before' => '<span class="text-icon arrow-r">',
            'after' => '</span>',
            'items_wrap'      => '<ul><h3 class="touch-toggle btn-red text-icon close-w">Back</h3>%3$s</ul>',
            'theme_location' => 'services-menu',         // where it's located in the theme
            'fallback_cb' => ''                          // fallback function (if there is one)
        )); ?>
      </li>
    </ul>

  </menu>

  <div class="nav-right <?php echo is_front_page() ? 'carousel' : 'nav-breadcrumbs' ?>" >

  <?php is_front_page() ? include( "index-carousel.php") : include("nav-breadcrumbs.php") ?>

  </div>


</nav>

