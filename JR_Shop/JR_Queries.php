<?php

global $wpdb, $categoriesList, $groupsList, $stainlessList, $brandsListMajor, $keywords,
      $categoriesListColumn, $brandsListFull, $rhcColumn, $rhcsColumn, $rhcListNew;
//get category array
$categoriesList = $wpdb->get_results("SELECT * FROM rhc_categories;", ARRAY_A);

//get keyword columns. For Smart Search
$groupsList = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` = 'group'");

$stainlessList = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` = 'stainless'");

$brandsListMajor = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` = 'brand'");

//get new items
$rhcListNew = $wpdb->get_col("SELECT `rhc` FROM `networked db` WHERE (`LiveonRHC` = 1 AND `Sold` = 0) ORDER BY `rhc` DESC LIMIT $itemCountMax") ;

/*Validation Querys \
\ for validation only. */
$brandsListFull = array_unique($wpdb->get_col("SELECT `Brand` FROM `networked db` WHERE `Brand` != '0' AND SOLD = 0"));
$categoriesListColumn = $wpdb->get_col("SELECT `name` FROM `rhc_categories`");
$rhcColumn = $wpdb->get_col("SELECT `rhc` FROM `networked db`");
$rhcsColumn = $wpdb->get_col("SELECT `rhcs` FROM `benchessinksdb`");
$keywords = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` LIKE '$keywordGroup'");


//----------------wpdb query generator---------------------------------------------------
//query for 'items full'
function jr_item_query($safeRHC, $SS = null) {
  global $wpdb;
  if ($SS) {
    $queryFull = $wpdb->get_row("SELECT `RHCs`, `Image`, `ProductName`, `Category`, `Height`, `Width`, `Depth`, `Price`, `Quantity`, `TableinFeet`, `Line1` FROM `benchessinksdb` WHERE RHCs = $safeRHC", ARRAY_A);
  } else {
    $queryFull = $wpdb->get_row("SELECT `RHC`, `Image`, `ProductName`, `Price`, `Height`, `Width`, `Depth`, `Model`, `Brand`, `Wattage`, `Power`, `ExtraMeasurements`, `Line 1`, `Line 2`, `Line 3`, `Condition/Damages`, `Sold`, `Quantity`, `Category`, `Cat1`, `Cat2`, `Cat3`, `SalePrice`, `IsSoon` FROM `networked db` WHERE RHC = $safeRHC", ARRAY_A);
  }
  return $queryFull;
}

function jr_category_row( $safeCategory ) {
  global $wpdb;
  return $wpdb->get_row("SELECT * FROM `rhc_categories` WHERE `Name` LIKE '$safeCategory'", ARRAY_A);
}

function jr_category_filter( $safeArr ) {

  global $wpdb, $itemCountMax;
  $fType = $safeArr['pgType'];

  $fSearch =      $safeArr['search'];
  $fBrand	=     $safeArr['brand'];
  $fCategory =    $safeArr['cat'];

  //setup LIKE parts of the query
  $searchPart = str_replace(" ", "|", $fSearch);
  $strSearch = ($fType == 'Search') ?
    "`ProductName` REGEXP '$searchPart' OR `Power` REGEXP '$searchPart' OR `Brand` REGEXP '$searchPart' "  : null;
  $strCategory = ($fType == 'Category') ?
    "`Category` LIKE '$fCategory' OR `Cat1` LIKE '$fCategory' OR `Cat2` LIKE '$fCategory' OR `Cat3` LIKE '$fCategory' " : null;
  $strCategorySS = ($fType == 'CategorySS')  ?
    "`Category` LIKE '$fCategory' " : null;
  $strBrand = ($fType == 'Brand') ?
    "`Brand` LIKE '$fBrand' " : null;

  //the query "start". what data are we getting?
  if ($fType == 'Soon' || $fType == 'Sold') {
    $queryStart = "SELECT `RHC`, `ProductName`, `Price`, `Image`, `IsSoon`, `Sold`, `Power` FROM `networked db` ";
  } elseif ($fType == 'CategorySS') {
    $queryStart = "SELECT `RHCs`, `ProductName`, `Price`, `Image`, `Category`, `TableinFeet` FROM `benchessinksdb` ";
  } else {
    $queryStart = "SELECT `RHC`, `ProductName`, `Image`, `IsSoon`, `Sold`, `Category`, `Power`, `Price`, `SalePrice` FROM `networked db` ";
  };

  //the query "middle". what is the data filtered by?
  if ($fType == 'Category' || $fType == 'Search' || $fType == 'CategorySS') {
    $queryMid = "WHERE (".implode(") OR (", array_filter([$strCategory, $strSearch, $strCategorySS])).") AND ";
  } elseif ($fBrand) {
    $queryMid = "WHERE $strBrand AND ";
  } else {
    $queryMid = "WHERE ";
  };

  //the query end. how is the data sorted?
  if ($fType == 'Soon' ) {
    $queryEnd = "(`LiveonRHC` = 0 AND `IsSoon` = 1) ORDER BY `RHC` DESC";
  } elseif ($fType == 'Sale' ) {
    $queryEnd = "(`LiveonRHC` = 1 AND `SalePrice` > 0 AND `Sold` = 0) ORDER BY `RHC` DESC";
  } elseif ($fType == 'Sold' ) {
    $queryEnd = "`Sold` = 1 ORDER BY `DateSold` DESC LIMIT $itemCountMax";
  } elseif ($fType == 'CategorySS') {
    $queryEnd = "`Sold` = 0 ORDER BY `RHCs` DESC";
  } elseif ($fType == 'New') {
    $queryEnd = "(`LiveonRHC` = 1 AND `Sold` = 0) ORDER BY `RHC` DESC LIMIT $itemCountMax";
  } else {
    $queryEnd =   "(`LiveonRHC` = 1 AND `Sold` = 0) ORDER BY `RHC` DESC";
  };


  //combine all
  $queryFull = $queryStart.$queryMid.$queryEnd;

  return $wpdb->get_results($queryFull, ARRAY_A);
  /*debug return*/
  //return $queryFull;

}

?>
