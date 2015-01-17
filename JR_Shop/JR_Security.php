<?php

/* SECURITY:
  > Since the Back-End is Based on in house PCs, theres a fairly limited amount that the customer can access.
  > no personal details are to be keeped on internet databases
  > Light security whitlelist sanitises the input to prevent injection just in case.
*/

//get url filter parameters and validate them for filter functions. also sets the defaults
function jr_validate_category_params($getArr) {
  $out = [
    'new'   => $getArr['new'] ?: false,
    'all'   => $getArr['all'] ?: false,
    'soon'  => $getArr['soon'] ?: false,
    'sold'  => $getArr['sold'] ?: false,
    'sale'  => $getArr['sale'] ?: false,

    'search' => jr_validate_search($getArr['search']),
    'cat'   => jr_validate_category($getArr['cat']),
    'stainless' => jr_validate_stainless($getArr['cat']),
    'brand' => jr_validate_brand($getArr['brand']) ];

  return $out;

};

//-------------------------------

//validates keywords
function jr_validate_keywords($rawIn, $keywordGroup) {
  global $wpdb;
  $whitelist = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` LIKE '$keywordGroup'");
  return in_array($rawIn, $whitelist) ? $rawIn : null  ;
}

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

//validates brands.
//note this is vs ALL brands in the db, not just the 'major' brand keywords
function jr_validate_brand($rawBrand) {
  global $brandsListFull;
  return in_array(ucwords($rawBrand), $brandsListFull) ? ucwords($rawBrand) : null;
};

/* sanitises the search, accepting only alphanumeric , replacing everything esle with a "?".

The goal is that if its a legit symbol in the search (eg. ',&,-) then a '?' will still pick them up in the regexp search.
If its not a legit symbol (eg. mysql injection) then the ? will wipe out all dangerous options.

This happens after the "smart auto complete" since they all vailidate against actual data */

function jr_validate_search($rawSearch) {
  return preg_replace("/[^[:alnum:][:space:]]/ui", '.?', $rawSearch);
};

?>
