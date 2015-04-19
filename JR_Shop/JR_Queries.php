<?php

//these are pretty much a lightweight cover over the wpdb class
function jr_query_col_unique($column, $table) {
  global $wpdb;

  $queryStr = "SELECT `$column` FROM `$table`";
  return array_unique($wpdb->get_col($queryStr));
}

function jr_query_keywords($keyword) {
  global $wpdb;

  $queryStr = "SELECT `keyword` FROM `keywords_db` WHERE `keywordGroup` = '$keyword'";
  return array_unique($wpdb->get_col($queryStr));
  //return $queryStr;
}

function jr_query_categories() {
  global $wpdb;

  return $wpdb->get_results("SELECT * FROM rhc_categories;", ARRAY_A);
}

function jr_query_carousel() {
  global $wpdb;

  return $wpdb->get_results("SELECT * FROM `carousel` WHERE `IsLive` = 1 ORDER BY `OrderNo` DESC;", ARRAY_A);
}

function jr_query_new() {
  global $itemCountMax, $wpdb;

  return $wpdb->get_col("SELECT `rhc` FROM `networked db` WHERE (`LiveonRHC` = 1 AND `Quantity` > 0) ORDER BY `rhc` DESC LIMIT $itemCountMax") ;
}

function jr_query_tesimonial($detail = null) {
  global $wpdb;

  $query = ($detail) ? 'Testimonial_Full' : 'Testimonial_Short';

  return $wpdb->get_results("SELECT `$query`, `Name` FROM `rhc_testimonial`;", ARRAY_A);
}

//----------------wpdb query generator---------------------------------------------------
//query for 'items full'
function jr_query_items($safeRHC, $SS = null) {
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

//limited by $itemCountMax
function jr_category_filter( $safeArr, $pageNumber) {
  global $wpdb, $itemCountMax;

  $queryOffset = ($pageNumber - 1) * $itemCountMax;

  $queryLimiter = " LIMIT $queryOffset,$itemCountMax";


  $queryAll = jr_string_build($safeArr);

  $queryFull = $queryAll.$queryLimiter;

  return $wpdb->get_results($queryFull, ARRAY_A);
  /*debug return*/
  //return $queryFull;
}
//count all items from query, for pagination
function jr_cat_count($safeArr) {
  global $wpdb;

//  if ($safeArr['pgType'] == 'New' || $safeArr['pgType'] == 'Sold') {
//    $out = $itemCountMax;
//  } else {
    $queryAll = jr_string_build($safeArr);
    $out = count($wpdb->get_col($queryAll));
//  }

  return $out;
}

//fills page with sold items. Mix of filler for design balance and show past sales.
function jr_cat_sold($safeArr, $itemsOnPage) {
  global $wpdb;

  if ($safeArr['pgType'] == 'New' || $safeArr['pgType'] == 'Sold') {
    $out = null;
  } else {
    $soldCount = ($itemsOnPage % 8);
    $queryAll = jr_string_build($safeArr);

    $querySoldOn = str_replace(['`Quantity` > 0','ORDER BY `RHC`'],
                               ['`Quantity` = 0','ORDER BY `DateSold`'], $queryAll);
    $queryLimiter = " LIMIT $soldCount";
    $queryFull = $querySoldOn.$queryLimiter;
  }

  return $wpdb->get_results($queryFull, ARRAY_A);
}

//builts the query strings for above functions functions
function jr_string_build($safeArr, $isCounter = false) {

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
  if ($isCounter && $fType == 'CategorySS') {
    $queryStart = "SELECT `RHCs` FROM `benchessinksdb` ";
  } elseif ($isCounter) {
    $queryStart = "SELECT `RHC` FROM `networked db` ";
  } elseif ($fType == 'CategorySS') {
    $queryStart = "SELECT `RHCs`, `ProductName`, `Price`, `Image`, `Category`, `TableinFeet` FROM `benchessinksdb` ";
  } else {
    $queryStart = "SELECT `RHC`, `ProductName`, `Image`, `IsSoon`, `Sold`, `Category`, `Power`, `Price`, `SalePrice`, `Quantity` FROM `networked db` ";
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
    $queryEnd = "(`LiveonRHC` = 1 AND `SalePrice` > 0 AND `Quantity` > 0) ORDER BY `RHC` DESC";
  } elseif ($fType == 'Sold' ) {
    $queryEnd = "`Sold` = 1 ORDER BY `DateSold` DESC";
  } elseif ($fType == 'CategorySS') {
    $queryEnd = "`Quantity` > 0 ORDER BY `RHCs` DESC";
  } else {
    $queryEnd =   "(`LiveonRHC` = 1 AND `Quantity` > 0) ORDER BY `RHC` DESC";
  };

  //combine all
  return $queryStart.$queryMid.$queryEnd;
}

?>
