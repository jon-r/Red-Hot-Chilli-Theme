<div class="container flex-container<?php echo is_front_page() ? ' home' : ' not-home' ?>">

  <a class="header-logo flex-2" href="<?php echo home_url(); ?>" rel="nofollow">
    <img src="<?php echo site_url(jr_imgSrc('rhc','RHC-Web','png')); ?>" alt="Red Hot Chilli - Used Catering Equipment"/>
  </a>


  <?php echo do_shortcode("[jr-shop id='search-bar']"); ?>

    <menu class="header-links flex-2 flex-container">

      <h3 class="text-icon-right phone-w"><?php echo jr_linkTo(phone) ?></h3>
      <a href="mailto:<?php echo jr_linkTo(email) ?>">
        <h3 class="text-icon-right email-w"><?php echo jr_linkTo(email) ?></h3>
      </a>

  </menu>



</div>
