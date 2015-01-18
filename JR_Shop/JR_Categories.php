<?php

//----------CategoryList filter function------------------------------------------------

//returns if item in group. one level deeper than the normal IN_ARRAY
function isGroup($group) {
  return function ($category) use ($group) {
    return ($category[CategoryGroup] == $group);
  };
}

function groupFilter($group) {
  global $categoriesList;
  return array_filter ($categoriesList, isGroup($group));
}



//----------------ItemList filter functions---------------------------------------------------------
/*
~need to look into setting up the benches page with categories. needs whole new functions?
~add sorting settings later
*/

//wpdb query generator
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
 // } elseif ($fStainless) {
 // $queryMid = "WHERE ".implode(") OR (", array_filter([$strCategorySS]))." AND ";
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
