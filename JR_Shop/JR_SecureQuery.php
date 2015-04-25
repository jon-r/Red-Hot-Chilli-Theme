<?php
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
    $out = $wpdb->get_results($queryFull);
  }

  return $out;
}

//fills page with sold items. Mix of filler for design balance and show past sales.
function jr_query_sold_filler($safeArr) {
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
      $out = $wpdb->get_results($queryFull);
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
  $out[noPrep] = jr_query_item_string($safeArr, $isCounter = true)[query];
  $out[prep] = $queryAll[placeholders] ? $wpdb->prepare($out[noPrep], $queryAll[placeholders]) : null;

  return $out;
}

function jr_query_item_string($safeArr, $isCounter = false) {

  $qType = $safeArr[pgType];

//the query "start". what data are we getting?
  if ($isCounter && $fType == 'CategorySS') {
    $queryStart = "SELECT `RHCs` FROM `benchessinksdb` ";
  } elseif ($isCounter) {
    $queryStart = "SELECT `RHC` FROM `networked db` ";
  } elseif ($fType == 'CategorySS') {
    $queryStart = "SELECT `RHCs`, `ProductName`, `Price`, `Category`, `TableinFeet`, `Quantity` FROM `benchessinksdb` ";
  } else {
    $queryStart = "SELECT `RHC`, `ProductName`, `Image`, `IsSoon`, `Sold`, `Category`, `Power`, `Price`, `SalePrice`, `Quantity` FROM `networked db` ";
  };
//the query "middle". what is the data filtered by?
  $queryMid = "WHERE "
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
/*
Sale = num
Sold
Soon
New
CatSS = c
Cat = c
Brand = b
Search = s

*/
//SELECT
//rhc
// - SELECT (rhcAll) from (netDB)
//rhcs
// - SELECT (rhcsAll) from (benchestDB)
//rhc_count
// - SELECT (rhc) from (netDB)
//rhcs_count
// - SELECT rhcs from (benchesDB)
//
//LIKE
//search
// - WHERE (`ProductName` REGEXP '$searchPart' OR `Power` REGEXP '$searchPart' OR `Brand` REGEXP '$searchPart')
//category
// - WHERE (`Category` LIKE '$fCategory' OR `Cat1` LIKE '$fCategory' OR `Cat2` LIKE '$fCategory' OR `Cat3` LIKE '$fCategory')
//soon
// - WHERE (`IsSoon` = 1)
//sale
// - WHERE (`IsSale` = $fSaleNum)
//brand
// - WHERE (`Brand` LIKE '$fBrand')
//
//ORDER
//sold
// - `Quantity` = 0 ORDER BY `DateSold` DESC
//not sold
// - (`LiveonRHC` = 1 AND `Quantity` > 0) ORDER BY `RHC` DESC"
//
//LIMIT
// - " LIMIT $soldCount"
// - " LIMIT $queryOffset,$itemCountMax"




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
    $queryStart = "SELECT `RHCs`, `ProductName`, `Price`, `Category`, `TableinFeet`, `Quantity` FROM `benchessinksdb` ";
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
