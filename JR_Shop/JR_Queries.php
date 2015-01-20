<?php

global $wpdb, $categoriesList, $groupsList, $stainlessList, $brandsListMajor, $keywords,
      $categoriesListColumn, $brandsListFull, $rhcColumn, $rhcsColumn;
//get category array
$categoriesList = $wpdb->get_results("SELECT * FROM rhc_categories;", ARRAY_A);

//get keyword columns. For Smart Search
$groupsList = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` = 'group'");

$stainlessList = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` = 'stainless'");

$brandsListMajor = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` = 'brand'");

//get array

/*Validation Querys \
\ for validation only. */
$brandsListFull = array_unique($wpdb->get_col("SELECT `Brand` FROM `networked db` WHERE `Brand` != '0' AND SOLD = 0"));
$categoriesListColumn = $wpdb->get_col("SELECT `name` FROM `rhc_categories`");
$rhcColumn = $wpdb->get_col("SELECT `rhc` FROM `networked db`");
$rhcsColumn = $wpdb->get_col("SELECT `rhcs` FROM `benchessinksdb`");
$keywords = $wpdb->get_col("SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` LIKE '$keywordGroup'");


//----------------wpdb query generator---------------------------------------------------
/*
~need to look into setting up the benches page with categories. needs whole new functions?
~add sorting settings later
*/

function jr_item_query($safeRHC, $SS = null) {
  global $wpdb;
  if ($SS) {
    $queryFull = $wpdb->get_row("SELECT `RHCs`, `ProductName`, `Category`, `Height`, `Width`, `Depth`, `Price`, `Quantity`, `TableinFeet`, `Line1` FROM `benchessinksdb` WHERE RHCs = $safeRHC", ARRAY_A);
  } else {
    $queryFull = $wpdb->get_row("SELECT `RHC`, `ProductName`, `Image`, `Price`, `Height`, `Width`, `Depth`, `Model`, `Brand`, `Wattage`, `Power`, `ExtraMeasurements`, `Line 1`, `Line 2`, `Line 3`, `Condition/Damages`, `Sold`, `Quantity`, `Category`, `Cat1`, `Cat2`, `Cat3`, `IsSale`, `IsSoon` FROM `networked db` WHERE RHC = $safeRHC", ARRAY_A);
  }
  return $queryFull;
}

function jr_category_row( $safeCategory ) {
  global $wpdb;
  return $wpdb->get_row("SELECT * FROM `rhc_categories` WHERE `Name` LIKE '$safeCategory'", ARRAY_A);
}

function jr_category_filter( $safeArr ) {

  global $wpdb, $itemCount;
  $fLatest =      $safeArr['new'];
  $fAll =         $safeArr['all']; //currently is all by default
  $fSoon =        $safeArr['soon'];
  $fRecentSold =  $safeArr['sold'];
  $fSale =        $safeArr['sale'];
  $fSearch =      $safeArr['search'];
  $fBrand	=     $safeArr['brand'];
  $fCategory =    $safeArr['cat'];
  $fStainless =   $safeArr['stainless'];

  //setup LIKE parts of the query
  $searchPart = str_replace(" ", "|", $fSearch);
  $strSearch = $fSearch ?
    "`ProductName` REGEXP '$searchPart' OR `Power` REGEXP '$searchPart' OR `Brand` REGEXP '$searchPart' "  : null;
  $strCategory = ($fCategory && ! $fStainless) ?
    "`Category` LIKE '$fCategory' OR `Cat1` LIKE '$fCategory' OR `Cat2` LIKE '$fCategory' OR `Cat3` LIKE '$fCategory' " : null;
  $strCategorySS = $fStainless ?
    "`Category` LIKE '$fCategory' " : null;
  $strBrand = $fBrand ?
    "`Brand` LIKE '$fBrand' " : null;

  //the query "start". what data are we getting?
  if ($fSoon || $fRecentSold) {
    $queryStart = "SELECT `RHC`, `ProductName`, `Image`, `IsSoon`, `Sold` FROM `networked db` ";
  } elseif ($fStainless) {
    $queryStart = "SELECT `RHCs`, `ProductName`, `Price`, `TableinFeet` FROM `benchessinksdb` ";
  } else {
    $queryStart = "SELECT `RHC`, `ProductName`, `Image`, `IsSoon`, `Sold`, `Category`, `Power`, `Price`, `IsSale` FROM `networked db` ";
  };

  //the query "middle". what is the data filtered by?
  if ($fCategory || $fSearch || $fStainless) {
    $queryMid = "WHERE (".implode(") OR (", array_filter([$strCategory, $strSearch, $strCategorySS])).") AND ";
  } elseif ($fBrand) {
    $queryMid = "WHERE $strBrand AND ";
  } else {
    $queryMid = "WHERE ";
  };

  //the query end. how is the data sorted?
  if ($fSoon) {
    $queryEnd = "(`LiveonRHC` = 0 AND `IsSoon` = 1) ORDER BY `RHC` DESC";
  } elseif ($fSale) {
    $queryEnd = "(`LiveonRHC` = 1 AND `IsSale` = 1 AND `Sold` = 0) ORDER BY `RHC` DESC";
  } elseif ($fRecentSold) {
    $queryEnd = "`Sold` = 1 ORDER BY `DateSold` DESC LIMIT $itemCount";
  } elseif ($fStainless) {
    $queryEnd = "`Sold` = 0 ORDER BY `RHCs` DESC";
  } elseif ($fLatest) {
    $queryEnd = "(`LiveonRHC` = 1 AND `Sold` = 0) ORDER BY `RHC` DESC LIMIT $itemCount";
  } else {
    $queryEnd =   "(`LiveonRHC` = 1 AND `Sold` = 0) ORDER BY `RHC` DESC";
  };


  //combine all
  $queryFull = $queryStart.$queryMid.$queryEnd;

  return $wpdb->get_results($queryFull, ARRAY_A);
  /*debug return*/
//  return $queryFull;

}




?>
