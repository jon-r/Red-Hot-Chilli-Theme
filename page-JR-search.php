<?php
/* Template Name: Search Pseudo-Page
*
* Just A Blank page to call the search function without any html
*
*/
if ($_GET[search]) {
  echo do_shortcode( "[jr-search']");
} else {
  echo do_shortcode( "[jr-shop id='404-filler']");
}

//to do - make a mini search template based on the 404 search
?>
