<nav class="primary-nav">

  <?php echo do_shortcode("[jr-shop id='shop-menu']"); ?>

  <?php echo is_front_page() ? null : do_shortcode("[jr-shop id='nav-breadcrumbs']"); ?>

</nav>
