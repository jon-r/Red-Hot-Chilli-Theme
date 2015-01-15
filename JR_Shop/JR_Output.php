<?php

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
    "(Down from £".$ref[Price].", saving you "
    .round(($ref[Price] - $ref[SalePrice]) / $ref[Price] * 100, 0)."%)" : null;

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



?>
