<?php
/* Template Name: Search Pseudo-Page
*
* Just A Blank page to call the search function without any html
*
* no end user will see this page
*/

  include( "JR_Shop/JR_Shop_Core.php");

 // $searchTerm = $_GET["search"];


 var_dump (jrx_smart_search($_GET[search]));

echo $_GET[search];
//todo -> 404 if somehow accessed without legit search
?>
