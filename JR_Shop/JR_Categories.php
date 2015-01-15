<?php

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

//wpdb query generator
function categoryFilter(
	$fLatest = 			false,
	$fAll =					false,
	$fSoon =				false,
	$fRecentSold =  false,
	$rawSearch = 		null,
	$rawBrand	= 		null,
	$rawCategory = 	null
) {
  global $wpdb, $itemCount, $categoriesList, $stainlessList;

	//gets validations before using in the mysql.
	//done after getting data from url since someone could type custom url
	$fCategory = 		jr_validate_category($rawCategory);
	$fStainless = 	jr_validate_stainless($rawCategory);
	$fSearch = 			jr_validate_search($rawSearch);
	$fBrand = 			jr_validate_brand($rawBrand);

  //default strings
  $queryStart = "SELECT `RHC`, `ProductName`, `Image`, `Price`, `Power`, `SalePrice` FROM `networked db` ";
	$queryMid = "WHERE ";
  $queryEnd =   "(`LiveonRHC` = 1 AND `Sold` = 0) ORDER BY `RHC` DESC";
	$lastMonth = "BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() ";

  //setup LIKE parts of the query
  $searchPart = str_replace(" ", "|", $fSearch);
  $strSearch = $fSearch ?
    "`ProductName` REGEXP '$searchPart' OR `Power` REGEXP '$searchPart' OR `Brand` REGEXP '$searchPart' "  : null;
  $strCategory = $fCategory ?
    "`Category` LIKE '$fCategory' OR `Cat1` LIKE '$fCategory' OR `Cat2` LIKE '$fCategory' OR `Cat3` LIKE '$fCategory' " : null;
  $strCategorySS = $fCategory ?
    "`Category` LIKE '$fCategory' " : null;
  $strBrand = $fBrand ?
    "`Brand` LIKE '$fBrand' " : null;

  //setup RANGE parts of query. NYI
  $strLength = $fLength ? "`TableinFeet` BETWEEN $fLength[0] AND $fLength[1] " : null;
  $strPrice = $fPrice ? "`Price` BETWEEN $fPrice[0] AND $fPrice[1] " : null;

  //customise the query "parts"
	if ($fAll) {
		//
	} elseif ($fSoon) {
		$queryStart = "SELECT `RHC`, `ProductName`, `Image` FROM `networked db` ";
		$queryEnd = "(`LiveonRHC` = 0 AND `Sold` = 0 AND `RHC` > 800) ORDER BY `RHC` DESC";
	} elseif ($fRecentSold) {
		$queryStart = "SELECT `RHC`, `ProductName`, `Image`, `DateSold` FROM `networked db` ";
		$queryMid = "WHERE `DateSold` $lastMonth AND ";
		$queryEnd = "`Sold` = 1 ORDER BY `RHC` DESC ";
	} elseif ($fStainless) {
    $queryStart = "SELECT `RHCs`, `ProductName`, `Price` FROM `benchessinksdb` ";
    $queryMid = ($strCategory || $strLength || $strPrice) ?
      "WHERE ".implode(") OR (", array_filter([$strCategorySS, $strLength, $strPrice]))." AND ": "WHERE ";
    $queryEnd = "`Sold` = 0 ORDER BY `RHCs` DESC";
  } elseif ($fLatest) {
    $queryEnd = "(`LiveonRHC` = 1 AND `Sold` = 0) ORDER BY `RHC` DESC LIMIT $itemCount";
	} elseif ($fBrand) {
		$queryMid = "WHERE $strBrand AND ";
	} else {
    $queryMid = ($strCategory || $strSearch || $strPrice) ?
      "WHERE (".implode(") OR (", array_filter([$strCategory, $strSearch, $strPrice])).") AND " : "WHERE ";
  }

  //combine all
  $queryFull = $queryStart.$queryMid.$queryEnd;

	return $wpdb->get_results($queryFull, ARRAY_A);
  /*debug return*/
//	return $queryFull;

}




?>
