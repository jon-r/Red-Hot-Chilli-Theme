<?php
$headerType = is_front_page() ? 'home' : 'not-home';
?>



<nav class="flex-container primary-nav">

<label class="menu-btn btn-red" for="menu-toggle">
  <h2 class="text-icon-left menu-w">Shop</h2>
</label>

<input type="checkbox"  id="menu-toggle">

  <menu class="nav-menu <?php echo $headerType ?>" >
    <?php echo do_shortcode("[jr-shop id='shop-menu' cached=false]"); ?>
  </menu>

  <?php if (is_front_page()) {
          echo do_shortcode("[jr-shop id='index-carousel' cached=true]");
        } else {
          echo do_shortcode("[jr-shop id='nav-breadcrumbs']");
        }
    ?>

</nav>


