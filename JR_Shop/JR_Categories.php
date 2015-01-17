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

/*
MIN

"SELECT `RHC`, `ProductName`, `Image`, `IsSoon`, `Sold` "
LITE
(above+)
`Category`, `Power`, `Price`, `IsSale`,

FULL
(above+)
`Brand`, `Wattage`, `Category`, `Height`, `Width`, `Depth`, `Height`, `Line1`, `Line2`, `Line3`, `Quantity`, `Model`, `ExtraMeasurements`, `Condition`, */

//wpdb query generator
function categoryFilter(
  $fLatest =  false,
  $fAll =     false,
  $fSoon =    false,
  $fRecentSold = false,
  $rawSearch =  null,
  $rawBrand	= null,
  $rawCategory =  null
) {
  global $wpdb, $itemCount, $categoriesList, $stainlessList;

	//gets validations before using in the mysql.
	//done after getting data from url since someone could type custom url
	$fCategory = 		jr_validate_category($rawCategory);
	$fStainless = 	jr_validate_stainless($rawCategory);
	$fSearch = 			jr_validate_search($rawSearch);
	$fBrand = 			jr_validate_brand($rawBrand);

  //default strings. ought to move outside as a global string to use on individual item query. or as functions?
	$queryStartMin = "SELECT `RHC`, `ProductName`, `Image`, `IsSoon`, `Sold` FROM `networked db` ";
	$queryStartLite = "SELECT `RHC`, `ProductName`, `Image`, `IsSoon`, `Sold`,
											`Category`, `Power`, `Price`, `IsSale` FROM `networked db` ";
	$queryStartFull = "SELECT `RHC`, `ProductName`, `Image`, `IsSoon`, `Sold`,
											`Category`, `Power`, `Price`, `IsSale`,
											`Brand`, `Wattage`, `Category`,
											`Height`, `Width`, `Depth`,
											`Line1`, `Line2`, `Line3`,
											`Quantity`, `Model`, `ExtraMeasurements`,
											`Condition` FROM `networked db` ";
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
		$queryStart = $queryStartMin;
		$queryEnd = "(`LiveonRHC` = 0 AND `Sold` = 0 AND `RHC` > 800) ORDER BY `RHC` DESC";
	} elseif ($fRecentSold) {
		$queryStart = $queryStartMin;
		$queryEnd = "`Sold` = 1 ORDER BY `DateSold` DESC LIMIT $itemCount";
	} elseif ($fStainless) {
    $queryStart = "SELECT `RHCs`, `ProductName`, `Price` FROM `benchessinksdb` ";
    $queryMid = ($strCategory || $strLength || $strPrice) ?
      "WHERE ".implode(") OR (", array_filter([$strCategorySS, $strLength, $strPrice]))." AND ": "WHERE ";
    $queryEnd = "`Sold` = 0 ORDER BY `RHCs` DESC";
  } elseif ($fLatest) {
    $queryStart = $queryStartLite;
		$queryEnd = "(`LiveonRHC` = 1 AND `Sold` = 0) ORDER BY `RHC` DESC LIMIT $itemCount";
	} elseif ($fBrand) {
		$queryStart = $queryStartLite;
		$queryMid = "WHERE $strBrand AND ";
	} else {
    $queryStart = $queryStartLite;
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
