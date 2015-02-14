<?php
  // featured items on front page


$arg = array(
	'methods' => array(
		'resize',
		'save'
	)
);
$img_editor_test = wp_image_editor_supports($arg);
if ($img_editor_test !== false) {
	echo "Image Editing  Supported!";} else {echo "no image edit" ;}

?>


<?php wp_nav_menu(array(
  'container' => '',                           // remove nav container
  'container_class' => '',                 // class of container (should you choose to use it)
  'menu' => __( 'Front Page Links', 'bonestheme' ),  // nav name
  'menu_class' => 'menu-featured',                             // adding custom nav class
  'theme_location' => 'front-page-list',          // where it's located in the theme
  'before' => '',                                 // before the menu
  'after' => '',                                  // after the menu
  'link_before' => '<h3>',                            // before each link
  'link_after' => '</h3>',                             // after each link
  'depth' => 0,                                   // limit the depth of the nav
  'fallback_cb' => ''                             // fallback function (if there is one)
)); ?>


