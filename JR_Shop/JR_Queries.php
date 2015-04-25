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

//query for the breadcrumbs/search, since the nav bar comes before the "main" query/compile
function jr_query_titles($safeRHC, $SS = null) {
  global $wpdb;
  if ($SS) {
    $ref = "RHCs";
    $tbl = "benchessinksdb";
  } else {
    $ref = "RHC";
    $db = "networked db";
  }

  return $wpdb->get_row("SELECT `ProductName`,`Category` FROM `$db` WHERE `$ref` LIKE '$safeRHC'", ARRAY_A);
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



//query for 'items full'
function jr_query_item($safeRHC, $SS = null) {
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

//----------------wpdb query generator---------------------------------------------------
//core catergory function
function jr_query_items( $safeArr, $pageNumber) {
  global $wpdb, $itemCountMax;

  $queryOffset = ($pageNumber - 1) * $itemCountMax;
  $queryLimiter = " LIMIT $queryOffset,$itemCountMax";
  $queryAll = jr_query_item_string($safeArr);
  $queryFull = $queryAll[query].$queryLimiter;

  if ($queryAll[placeholders]) {
    $out = $wpdb->get_results(
      $wpdb->prepare($queryFull, $queryAll[placeholders])
    , ARRAY_A);
  } else {
    $out = $wpdb->get_results($queryFull, ARRAY_A);
  }

  return $out;
}

//fills page with sold items. Mix of filler for design balance and show past sales.
function jr_query_sold($safeArr) {
  global $wpdb;

  if ($safeArr['pgType'] == 'New' || $safeArr['pgType'] == 'Sold') {
    $out = null;
  } else {
    $soldCount = ($itemsOnPage % 8);
    $queryAll = jr_query_item_string($safeArr);

    $querySoldOn = str_replace(['`Quantity` > 0','ORDER BY `RHC`'],
                               ['`Quantity` = 0','ORDER BY `DateSold`'], $queryAll[query]);
    $queryLimiter = " LIMIT $soldCount";
    $queryFull = $querySoldOn.$queryLimiter;

    if ($queryAll[placeholders]) {
      $out = $wpdb->get_results(
        $wpdb->prepare($queryFull, $queryAll[placeholders])
      , ARRAY_A);
    } else {
      $out = $wpdb->get_results($queryFull, ARRAY_A);
    }
  }

  return $out;
}
//count all items from query, for pagination
function jr_query_item_count($safeArr) {
    global $wpdb;

    $queryFull = jr_query_item_string($safeArr, $isCounter = true);

    if ($queryAll[placeholders]) {
      $column = $wpdb->get_col(
        $wpdb->prepare($queryFull, $queryAll[placeholders])
      );
    } else {
      $column = $wpdb->get_col($queryAll);
    }

    $out = count($column);

  return $out;
}

function jr_query_debug($safeArr) {
  global $wpdb;
  $query = jr_query_item_string($safeArr, $isCounter = true);

  $out[noPrep] = $query[query];
  $out[prep] = $query[placeholders] ? $wpdb->prepare($query[query], $query[placeholders]) : null;
  //$out[placeholder] = $queryAll[placeholders];

  return $out;
}

function jr_query_item_string($safeArr, $isCounter = false) {

  $qType = $safeArr[pgType];

//the query "start". what data are we getting?
  if ($isCounter && $qType == 'CategorySS') {
    $queryStart = "SELECT `RHCs` FROM `benchessinksdb` ";
  } elseif ($isCounter) {
    $queryStart = "SELECT `RHC` FROM `networked db` ";
  } elseif ($qType == 'CategorySS') {
    $queryStart = "SELECT `RHCs`, `ProductName`, `Price`, `Category`, `TableinFeet`, `Quantity` FROM `benchessinksdb` ";
  } else {
    $queryStart = "SELECT `RHC`, `ProductName`, `Image`, `IsSoon`, `Sold`, `Category`, `Power`, `Price`, `SalePrice`, `Quantity` FROM `networked db` ";
  };
//the query "middle". what is the data filtered by?
  $queryMid = "WHERE ";
  if ($qType == 'Category') {
    $queryMid = "WHERE (`Category` LIKE %s OR `Cat1` LIKE %s OR `Cat2` LIKE %s OR `Cat3` LIKE %s) AND ";
    $qValue = $safeArr[cat];
  } elseif ($qType == 'Search') {
    $queryMid = "WHERE (`ProductName` REGEXP %s OR `Power` REGEXP %s OR `Brand` REGEXP %s) AND ";
    $qValue = $safeArr[search]; //PUT searchstr to regex in validation
  } elseif ($qType == 'CategorySS') {
    $queryMid = "WHERE (`Category` LIKE %s) AND ";
    $qValue = $safeArr[cat];
  } elseif ($qType == 'Brand') {
    $queryMid = "WHERE (`Brand` LIKE %s) AND ";
    $qValue = $safeArr[brand];
  } elseif ($qType =='Sale') {
    $queryMid = "WHERE (`IsSale` = %d) AND ";
    $qValue = $safeArr[saleNum];
  };
//the query end. how is the data sorted?
  $queryEnd = "(`LiveonRHC` = 1 AND `Quantity` > 0) ORDER BY `RHC` DESC";
  if ($qType == 'Soon' ) {
    $queryEnd = "(`LiveonRHC` = 0 AND `IsSoon` = 1) ORDER BY `RHC` DESC";
  } elseif ($qType == 'Sold' ) {
    $queryEnd = "`Quantity` = 0 ORDER BY `DateSold` DESC";
  } elseif ($qType == 'CategorySS') {
    $queryEnd = "`Quantity` > 0 ORDER BY `RHCs` DESC";
  };
//queryPlaceholders (for wpdb->prepare)
  $qArray = null; //no prepare of non-variables
  if ($qType == 'Category') {
    $qArray = [ $qValue, $qValue, $qValue, $qValue ];
  } elseif ($qType == 'Search') {
    $qArray = [ $qValue, $qValue, $qValue ];
  } elseif ($qType == 'CategorySS' || $qType == 'Brand' || $qType =='Sale') {
    $qArray = [ $qValue ];
  }

  $out[query] = $queryStart.$queryMid.$queryEnd;
  $out[placeholders] = $qArray;

  return $out;
}

?>
