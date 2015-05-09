<?php
/* Template Name: Search Pseudo-Page
*
* Just A Blank page to call the search function without any html
*
* THIS IS NOT A NORMAL TEMPLATE. Use page-search.php
*/
if ($_GET[search]) {
  echo do_shortcode( "[jr-search']");
} else {
  echo do_shortcode( "[jr-shop id='404-filler']");
}

?>
