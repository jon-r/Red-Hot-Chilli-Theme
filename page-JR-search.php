<?php
/* Template Name: Search Pseudo-Page
*
* Just A Blank page to call the search function without any html
*/

	include( "JR_Shop/JR_Shop_Core.php");

	$searchTerm = $_GET["search"];
	jr_smart_search($searchTerm);

?>
