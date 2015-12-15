<nav class="primary-nav">

<<<<<<< HEAD
  <?php echo do_shortcode("[jr-shop id='shop-menu' ]"); ?>
  <?php echo is_front_page() ? null : do_shortcode("[jr-shop id='nav-breadcrumbs']"); ?>

</nav>
=======
  <?php echo do_shortcode("[jr-shop id='shop-menu' cached=true]"); ?>
>>>>>>> refs/remotes/origin/master

  <?php if (!is_front_page()) {  echo do_shortcode("[jr-shop id='nav-breadcrumbs']"); } ?>

</nav>
