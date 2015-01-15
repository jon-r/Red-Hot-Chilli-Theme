<?php

/* SECURITY:
  > Since the Back-End is Based on in house PCs, theres a fairly limited amount that the customer can access.
  > no personal details are to be keeped on internet databases
  > Light security whitlelist sanitises the input to prevent injection just in case.
*/


//validates categories, makes sure exists
function jr_validate_category($rawCategory) {
	global $categoriesListColumn;
	return in_array($rawCategory, $categoriesListColumn) ? $rawCategory : null ;
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


//validates brands
function jr_validate_brand($rawBrand) {
	global $brandsListFull;
	return in_array(ucwords($rawBrand), $brandsListFull) ? ucwords($rawBrand) : null;
};

/* sanitises the search, accepting only alphanumeric , replacing everything esle with a "?".

The goal is that if its a legit symbol in the search (eg. ',&,-) then a ? will still pick them up in the regexp search.
If its not a legit symbol (eg. mysql injection) then the ? will wipe out all dangerous options.

This happens after the "smart auto complete" since they will vailidate against actual data */

function jr_validate_search($rawSearch) {
	return preg_replace("/[^[:alnum:][:space:]]/ui", '.?', $rawSearch);
}

?>
