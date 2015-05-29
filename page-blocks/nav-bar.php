<?php
/* list of groups on menu + custom links */
?>

<nav class="flex-container primary-nav">
  <label class="menu-btn btn-red" for="menu-toggle">
    <h2 class="text-icon-left menu-w">Shop</h2>
  </label>
  <input type="checkbox"  id="menu-toggle">
  <menu class="nav-menu<?php echo is_front_page() ? ' home' : ' not-home' ?>" >
    <ul class="main-menu" id="js-main-list" >
      <?php echo do_shortcode("[jr-shop id='shop-menu']"); ?>
<?php // wp menus start here. admin for setup --> ?>
      <li>Featured
        <?php wp_nav_menu(array(
            'container' => '',                           // remove nav container
            'menu' => __( 'Featured Menu Links', 'bonestheme' ),  // nav name
            'before' => '<span class="text-icon arrow-r">',
            'after' => '</span>',
            'items_wrap'      => '<ul class="sub-menu" ><h3 class="touch-toggle btn-red text-icon close-w">Back</h3>%3$s</ul>',
            'theme_location' => 'featured-menu',         // where it's located in the theme
            'fallback_cb' => ''                          // fallback function (if there is one)
        )); ?>
      </li>
      <li>Other Services
        <?php wp_nav_menu(array(
            'container' => '',
            'menu' => __( 'Services Menu links', 'bonestheme' ),  // nav name
            'before' => '<span class="text-icon arrow-r">',
            'after' => '</span>',
            'items_wrap'      => '<ul class="sub-menu" ><h3 class="touch-toggle btn-red text-icon close-w">Back</h3>%3$s</ul>',
            'theme_location' => 'services-menu',         // where it's located in the theme
            'fallback_cb' => ''                          // fallback function (if there is one)
        )); ?>
      </li>
    </ul>

  </menu>

  <?php if (is_front_page()) {
          echo do_shortcode("[jr-shop id='index-carousel']");
        } else {
          echo do_shortcode("[jr-shop id='nav-breadcrumbs']");
        }
    ?>

</nav>

