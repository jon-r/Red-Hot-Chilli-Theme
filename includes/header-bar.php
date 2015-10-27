<?php $headerType = is_front_page() ? 'home' : 'not-home'; ?>
<div class="container flex-container centre <?php echo $headerType ?>">

  <a class="header-logo flex-2" href="<?php echo home_url(); ?>" rel="nofollow">
    <img src="<?php echo jr_siteImg('rhc/RHC-Web.png'); ?>"
         class="framed" alt="Red Hot Chilli - Used Catering Equipment"/>
  </a>

  <menu id="js-form-complete" class="header-links flex-2" href="<?php echo home_url(); ?>">

    <h2 class="text-icon-left phone-w"><?php echo jr_linkTo('phone') ?></h2>
    <h2 class="text-icon-left email-w"><?php echo jr_linkTo('eLink') ?></h2>

    <?php echo do_shortcode( "[jr-shop id='header-search' cached=true]"); ?>

  </menu>

</div>
