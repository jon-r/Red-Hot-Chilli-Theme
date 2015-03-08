<?php
  // featured items on front page
?>


<?php wp_nav_menu(array(
  'container' => '',                           // remove nav container
  'menu' => __( 'Front Page Links', 'bonestheme' ),  // nav name
  'menu_class' => 'menu-featured',                             // adding custom nav class
  'theme_location' => 'front-page-list',          // where it's located in the theme
  'link_before' => '<h3>',                            // before each link
  'link_after' => '</h3>',                             // after each link
  'theme_location' => 'front-page-list',
  'fallback_cb' => ''                             // fallback function (if there is one)
)); ?>
