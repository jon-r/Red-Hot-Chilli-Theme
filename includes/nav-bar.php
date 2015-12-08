<nav class="primary-nav">

  <?php echo do_shortcode("[jr-shop id='shop-menu' cached=true]"); ?>

  <?php if (is_front_page()) : ?>
    <script type="text/javascript" >
      document.getElementById('js-main-list').parentElement.className = "nav-left-menu forceOpen";
    </script>
  <?php else : ?>

    <?php do_shortcode("[jr-shop id='nav-breadcrumbs']"); ?>

  <?php endif ?>

</nav>


