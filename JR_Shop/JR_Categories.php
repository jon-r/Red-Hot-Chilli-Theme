<?php

//----------set global variables-----------------------------------------------------------------

global $wpdb, $categoriesList, $itemsList;

//get category array
$categoriesList = $wpdb->get_results("SELECT * FROM rhc_categories;", ARRAY_A);

//sorts the category pages
function isGroup($group) {
  return function ($category) use ($group) {
    return ($category[CategoryGroup] == $group);
  };
};

//----------------ItemList filter functions---------------------------------------------------------
/*
~need to look into setting up the benches page with categories. needs whole new functions?
~add sorting settings later
~search function will be where all the security takes place (todo later)

filters:
  category = by category,cat1,cat2,cat3
  latest  = first page of items
  search = user input (simple strings from search function)
  advSearch = more complex - lets do seperate
  brand = sort by brand
  Stainless steel (break into sink/table/shelving)
  AllItems = get all
*/

function categoryFilter(
  $fLatest = false,
  $fSearch = null,  $fBrand = null,  $fCategory = null,
  $fLength = null,  $fPrice = null
) {
  global $wpdb, $itemCount, $categoriesList, $categoriesStainless;

  $fStainless = in_array($fCategory[0], $categoriesStainless); //  ? true : false;

  //default strings
  $queryStart = "SELECT `RHC`, `ProductName`, `Image`, `Price`, `Power`, `SalePrice` FROM `networked db` ";
  $queryEnd =   " `Sold` = 0 ORDER BY `RHC` DESC";

  //setup LIKE parts of the query
  $searchPart = str_replace(" ", "|", $fSearch);
  $strSearch = $fSearch ?
    "`ProductName` REGEXP '$searchPart' OR `Power` REGEXP '$searchPart' OR `Brand` REGEXP '$searchPart'" : null;
  $strCategory = $fCategory ?
    "`Category` LIKE '$fCategory' OR `Cat1` LIKE '$fCategory' OR `Cat2` LIKE '$fCategory' OR `Cat3` LIKE '$fCategory'" : null;
  $strCategorySS = $fCategory ?
    "`Category` LIKE $fCategory" : null;
  $strBrand = $fBrand ?
    "`Brand` LIKE $fBrand" : null;

  //setup RANGE parts of query.
  $strLength = $fLength ? "`TableinFeet` BETWEEN $fLength[0] AND $fLength[1]" : null;
  $strPrice = $fPrice ? "`Price` BETWEEN $fPrice[0] AND $fPrice[1]" : null;

  //customise the query "parts"
  if ($fStainless) {
    $queryStart = "SELECT `RHCs`, `ProductName`, `Price` FROM `benchessinksdb` ";
    $queryMid = ($strCategory || $strLength || $strPrice) ?
      "WHERE ".implode(") OR (", array_filter([$strCategorySS, $strLength, $strPrice]))." AND": " WHERE";
    $queryEnd = " `Sold` = 0 ORDER BY `RHCs` DESC";
  } elseif ($fLatest) {
    $queryEnd = "WHERE `Sold` = 0 ORDER BY `RHC` DESC LIMIT $itemCount";
  } else {
    $queryMid = ($strCategory || $strSearch || $strBrand || $strPrice) ?
      " WHERE (".implode(") OR (", array_filter([$strCategory, $strSearch, $strBrand, $strPrice])).") AND" : " WHERE";
  }

  //combine all
  $queryFull = $queryStart.$queryMid.$queryEnd;

 return $wpdb->get_results($queryFull, ARRAY_A);
  //debug return
 //return $queryFull;

}




?>
