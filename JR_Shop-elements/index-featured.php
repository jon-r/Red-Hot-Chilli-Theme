<?php //placeholder featured menu

//temp list, 4 featured buttons. to pair with the featured menu. currently featured elements are in a array
//... to convert to another menu like other services.



?>

<article class="featured links" >
        <?php wp_nav_menu(array(
          'container' => '',                           // remove nav container
          'container_class' => '',                 // class of container (should you choose to use it)
          'menu' => __( 'Front Page Links', 'bonestheme' ),  // nav name
          'menu_class' => '',               // adding custom nav class
          'theme_location' => 'front-page-list',                 // where it's located in the theme
          'before' => '',                                 // before the menu
          'after' => '',                                  // after the menu
          'link_before' => '',                            // before each link
          'link_after' => '',                             // after each link
          'depth' => 0,                                   // limit the depth of the nav
          'fallback_cb' => ''                             // fallback function (if there is one)
        )); ?>
</article>

