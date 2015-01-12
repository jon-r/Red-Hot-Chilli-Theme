<?php
//----------set global variables-----------------------------------------------------------------
include('Website-Config.php');

global $wpdb, $categoriesList, $itemsList, $groupsURLs;



//get category array
$categoriesList = $wpdb->get_results("SELECT * FROM rhc_categories;", ARRAY_A);


//flipped to get url from name. not sure if used
$groupsURLs = array_flip ($groupsList);

//filters the group pages
function isGroup($group) {
	return function ($category) use ($group) {
		return ($category[CategoryGroup] == $group);
	};
};

//----------OBSOLETE, both to be replaced---------------------------------------------------------

$itemsList = $wpdb->get_results("SELECT `RHC`, `ProductName`, `Image`, `Price`, `Brand`, `Power`, `Sold`, `Category`, `Cat1`, `Cat2`, `Cat3`, `SalePrice` FROM `networked db` WHERE `Sold` = 0
ORDER BY `RHC` ASC;", ARRAY_A);

function isCategory($category) {
	return function ($item) use ($category) {
		return ($item[Category] == $category ||
				$item[Cat1] == $category ||
				$item[Cat2] == $category ||
				$item[Cat3] == $category);
	};
};

//----------------ItemList filter functions---------------------------------------------------------
/*
~need to look into setting up the benches page with categories. needs whole new functions?
~add sorting settings later
~search function will be where all the security takes place (todo later)


filters:
	category = by category,cat1,cat2,cat3 		|done|
	latest  = first page of items
	search	 = user input (simple)
	advSearch = more complex lets do seperate
	brand	 = sort by brand
	Stainless steel (break into sink/table)
	AllItems = get all
*/

//array of filters to mysql string
function arrayToQuery($array) {
	if ($array) {
		$x = (count($array) > 1) ? "REGEXP " : "LIKE ";
		$y = "'".implode("|",$array)."'";
		return $x.$y;
	} else {
		return null;
	}
}

function categoryFilter(
	//boolean option
	$fLatest = false,
	//query arrays of 1+ values
	$fSearch = null,
	$fBrand	= null,		$fCategory = null,
	//ranges should be array of two [MIN,MAX]
	$fLength = null,	$fPrice = null
) {
	global $wpdb, $itemCount, $categoriesList, $categoriesStainless;

	$fStainless = in_array($fCategory[0], $categoriesStainless); //  ? true : false;

	//start + end of the query
	$queryStart =  	"SELECT `RHC`, `ProductName`, `Image`, `Price`, `Power`, `SalePrice` FROM `networked db` ";
	$queryEnd = 	"`Sold` = 0 ORDER BY `RHC` DESC";

	//setup LIKE parts of the query
	$searchPart = arrayToQuery($fSearch);
	$strSearch = $fSearch ?
		"`ProductName` $searchPart OR `Power` $searchPart OR `Brand` $searchPart" : null;

	$catPart = arrayToQuery($fCategory);
	$strCategory = $fCategory ?
		"`Category` $catPart OR `Cat1` $catPart OR `Cat2` $catPart OR `Cat3` $catPart" : null;
	$strCategorySS = $fCategory ?
		"`Category` $catPart" : null;
	$strBrand = $fBrand ? "`Brand`".arrayToQuery($fBrand) : null;

	//setup RANGE parts of query.
	$strLength = $fLength ? "`TableinFeet` BETWEEN $fLength[0] AND $fLength[1]" : null;
	$strPrice = $fPrice ? "`Price` BETWEEN $fPrice[0] AND $fPrice[1]" : null;

	//combine strings based on bool
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
//	return in_array($fCategory[0], $ssCats) ? 'true' : 'false';
//	return $queryFull;

//PREPARE THE OUTPUTS MAYBE???!!!??!?!?!? could try sanitising input?
	//	$out = $wpdb->query(
//		$wpdb->prepare(
//			$query, $argsList
//		), ARRAY_A);
}


//----------------Search Button------------------------------------------------------------------


// ----------------------array compiler-----------------------------------------------------------
// Converts raw databases into useful "chunks" of text
//$ref = associative array generated from the database/filters
function rhcCompile($ref){
	//changeto permalinks eventually
	$out[weblink] = "?page_id=21&r=".$ref[RHC];

	$out[rhc] = "RHC".$ref[RHC];

	$out[name] = $ref[ProductName];

	//sale if sale>0, normal price if sale=0
	$correctPrice = $ref[SalePrice] == 0 ? $ref[Price] : $ref[SalePrice];
	//get the listing price to show, including sales and SOLD.
	$out[price] = "£".$correctPrice." + VAT";

	//get % reduction if saleprice exists
	$out[reduction] = $ref[SalePrice] != 0 ?
		"(Down from £".$ref[Price].", saving you ".round(($ref[Price] - $ref[SalePrice]) / $ref[Price] * 100, 0)."%)" : null;

	//get VAT price
	$out[vatPrice] = "(£".($correctPrice * 1.2)." incl. VAT)";

	$imgLocation = '../redhotchilli/wp-content/uploads/gallery/'.$ref[Image];
	//gets first image. need to fix something for a b c d e
	$out[imgFirst] = $imgLocation.".jpg";

	//gets list of all images.
	$out[imgAll] = glob($imgLocation.'*');

	//get dimensions in mm/inches output. TODO maybe create a mini dimension cube from these? thinking 3d css
	$out[height] = $ref[Height] != 0 ? "Height: ".$ref[Height]."mm / ".ceil($ref[Height] / 25.4)." inches" : null;
	$out[width] = $ref[Width] != 0 ? "Width: ".$ref[Width]."mm / ".ceil($ref[Width] / 25.4)." inches" : null;
	$out[depth] = $ref[Depth] != 0 ? "Depth: ".$ref[Depth]."mm / ".ceil($ref[Depth] / 25.4)." inches" : null;

	$out[fullSizes] = $out[height]."<br>".$out[width]."<br>".$out[depth];

	//get brand of the item as icon or text. if there is a logo in the folder, use that.
	$brandIconLocation = '../redhotchilli/wp-content/uploads/icons/'.str_replace(" ", "-", $ref[Brand]).".jpg";
	$out[brand] = $ref[Brand] != "0" ? (file_exists ( $brandIconLocation ) ?
		"<img src='$brandIconLocation' />" :
		"Brand: ".$ref[Brand]) : null;
	//TODO link to the "sort by brand" page

	//get wattage if exists. goes to KW if above 1500w
	$out[watt] = $ref[Wattage] != 0 ? ($ref[Wattage] > 1500 ? ($ref[Wattage] / 1000)."kw" : $ref[Wattage]." watts") : null;

	//get power of the item as icon, else leave blank.
	$powerIconLocation = '../redhotchilli/wp-content/uploads/icons/'.str_replace(" ", "-", $ref[Power]).".png";
	$out[power] = file_exists ($powerIconLocation) ?
		"<img src='$powerIconLocation' />" : null;

	//concatenate description into one string
	$out[desc] =
		($ref[Line1] != " " ? $ref[Line1]."<br>" : null).
		($ref[Line2] != " " ? $ref[Line2]."<br>" : null).
		($ref[Line3] != " " ? $ref[Line3] : null);

	//show quantity only if more than one
	$out[count] = $ref[Quantity] > 1 ? $ref[Quantity]." in Stock" : null;

	//the rest are just "show if exists". wouldnt need, but DB cant have blanks. sold is temp removed
	$out[model] = $ref[Model] != "0" ? "Model: ".$ref[Model] : null;
	$out[extra] = $ref[ExtraMeasurements] != " " ? $ref[ExtraMeasurements] : null;
	//$out[sold] = $ref[Sold] ? "SOLD" : null;
	$out[condition] = $ref[Condition] != " " ? $ref[Condition] : null;

	//puts all the above into an array, to be used wherever
	return $out;
}

//cutback function, for pages with less info to show
function rhcCompileLite($ref){
	$out[weblink] = "?page_id=21&r=".$ref[RHC];
	$out[rhc] = "RHC".$ref[RHC];
	$out[name] = $ref[ProductName];
	$correctPrice = $ref[SalePrice] == 0 ? $ref[Price] : $ref[SalePrice];
	$out[price] = "£".$correctPrice." + VAT";
	$out[reduction] = $ref[SalePrice] != 0 ? "(Was £".$ref[Price].")" :	null;
	$imgLocation = '../redhotchilli/wp-content/uploads/gallery/'.$ref[Image];
	$out[imgFirst] = $imgLocation.".jpg";
	$powerIconLocation = '../redhotchilli/wp-content/uploads/icons/'.str_replace(" ", "-", $ref[Power]).".png";
	$out[power] = file_exists ($powerIconLocation) ? "<img src='$powerIconLocation' />" : null;
	//$out[sold] = $ref[Sold] ? "SOLD" : null;
	return $out;
}
