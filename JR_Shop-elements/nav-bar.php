<?php /* list of groups on menu + custom links */
 /*
  [RHC ICON]          [SEARCH ]           [other links]
_________________________________________________________
[MENU BUTTON]  [ HOME > GROUP > CATEGORY > ITEM ]
                      > SPECIAL PAGE(S)
*/
?>
<nav class="primary-nav">
  <input type="checkbox"  id="menu-toggle">
  <div class="nav-main<?php echo is_front_page() ? ' home' : ' not-home' ?>" >
    <label class="menu-btn" for="menu-toggle"><h2>Browse</h2></label>
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
          <li ><a class="arrow-r" href="?<?php echo $link ?>" ><?php echo $category[Name] ?></a></li>
          <?php endforeach ?>
        </ul>
      </li>

    <?php endforeach ?>
<?php // wp menus start here. admin for setup --> ?>
      <li><h4>Featured</h4>
        <?php wp_nav_menu(array(
          'container' => '',                           // remove nav container
          'menu' => __( 'Featured Menu Links', 'bonestheme' ),  // nav name
          'menu_class' => 'menu-arrow-r',                          // adding custom nav class
          'theme_location' => 'featured-menu',         // where it's located in the theme
          'fallback_cb' => ''                          // fallback function (if there is one)
        )); ?>
      </li>
      <li><h4>Other Services</h4>
        <?php wp_nav_menu(array(
          'container' => '',                           // remove nav container
          'menu' => __( 'Services Menu links', 'bonestheme' ),  // nav name
          'menu_class' => 'menu-arrow-r',                          // adding custom nav class
          'theme_location' => 'services-menu',         // where it's located in the theme
          'fallback_cb' => ''                          // fallback function (if there is one)
        )); ?>
      </li>
    </ul>

  </div>

  <div class="nav-right <?php echo is_front_page() ? 'carousel' : 'nav-breadcrumbs' ?>" >

  <?php is_front_page() ? include( "index-carousel.php") : include("nav-breadcrumbs.php") ?>

  </div>


</nav>

