<?php

/* SECURITY:
  > Since the Back-End is Based on in house PCs, theres a fairly limited amount that the customer can access.
  > no personal details are to be keeped on internet databases
  > Light security whitlelist sanitises the input to prevent injection just in case.
*/

//whiteLists for the security.
//currently selects only letters, numbers, and the symbols '" /+-
$searchFilter = "['\" /+-]|\w";

//validates categories, makes sure exists
function jr_validate_category($rawCategory) {
	global $wpdb;
	$categoriesList = $wpdb->get_col("SELECT `name` FROM `rhc_categories`");
	return in_array($rawCategory, $categoriesList) ? $rawCategory : null ;
};

//validates stainless pages,
//returns TRUE/FALSE (this is only being used as a switch between stainless and standard product tables)
//TODO, check for RHCs
function jr_validate_stainless($rawStainless) {
	global $stainlessList;
	return in_array($rawStainless, $stainlessList);
};

//validates RHC numbers
//TODO RHCs
function jr_validate_RHC($rawSearch){
	return (strpos($rawSearch, 'rhc') !== FALSE) ? str_replace('rhc', '', $rawSearch) : null;
};

//validates brands
function jr_validate_brand($rawBrand) {
	global $brandsListFull;
	return in_array($rawBrand, $brandsListFull);
};

/* sanitises the search, accepting only alphanumeric , replacing everything esle with a "?".

The goal is that if its a legit symbol in the search (eg. ',&,-) then a ? will still pick them up in the regexp search.
If its not a legit symbol (eg. mysql injection) then the ? will wipe out all dangerous options.

This happens after the "smart auto complete" since they will vailidate against actual data */

function jr_search_sanitise($rawSearch) {
	return preg_replace("/[^[:alnum:][:space:]]/ui", '.?', $rawSearch);
}

?>
