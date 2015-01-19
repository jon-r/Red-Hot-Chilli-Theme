<?php
global $wpdb, $itemCount, $itemCountMin, $categoriesList,
				$groupsList, $stainlessList, $brandsListMajor,
				$categoriesListColumn, $brandsListFull;

/* Global Variables \
\ This should be the only section to that needs editing  */

//how many items before pagination. Also limits "new items" page. NYI
$itemCount = 20;

//How many items before the "try elsewhere" kicks in. NYI
$itemCountMin = 4;

/* Database GETS \
\ Fetching varying chunks of DB */

//get category array
$categoriesList = $wpdb->get_results("SELECT * FROM rhc_categories;", ARRAY_A);

//get keyword columns. For Smart Search
$groupsList = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` = 'group'");

$stainlessList = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` = 'stainless'");

$brandsListMajor = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` = 'brand'");


/*Validation GETS \
\full lists take from the main DB, for validation only. */
$brandsListFull = array_unique($wpdb->get_col("SELECT `Brand` FROM `networked db` WHERE `Brand` != '0' AND SOLD = 0"));
$categoriesListColumn = $wpdb->get_col("SELECT `name` FROM `rhc_categories`");

/*img location \
\ potentially changed when proper urls are named */
function imgSrcRoot($itemType,$itemName,$filetype) {
  return '<img src="'.site_url().'/wp-content/uploads/'.$itemType.'/'.$itemName.'.'.$filetype.'" />';
}

function imgSrcURL($itemType,$itemName) {
  return site_url().'/wp-content/uploads/'.$itemType.'/'.$itemName;
}

?>
