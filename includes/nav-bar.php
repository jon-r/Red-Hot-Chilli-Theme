<nav class="primary-nav">
  <?php echo do_shortcode("[jr-shop id='shop-menu' cached=true]"); ?>

  <?php if (is_front_page()) {
          echo do_shortcode("[jr-shop id='index-carousel' cached=true]");
        } else {
          echo do_shortcode("[jr-shop id='nav-breadcrumbs']");
        }
    ?>
  <br>

</nav>


