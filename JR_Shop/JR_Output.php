<?php

// ----------------------array compiler-----------------------------------------------------------
// Converts raw databases into useful "chunks" of text
//$ref = associative array generated from the database/filters
//new plan: keep this function as minimal as possible, returning just minimal strings. do the design in the templates
function imgSrcRoot($itemType,$itemName) {
  return '../redhotchilli/wp-content/uploads/'.$itemType.'/'.$itemName;
}

function rhcCompile($ref,$detail){
  //min = basic detail - things not for sale atm
  if ($detail == 'min' || 'lite' || 'full') {
    //change to permalinks eventually
    $out[webLink] = http_build_query(['page_id' => 21,
                                      'r' => $ref[RHC],
                                      'n' => $ref[ProductName]]);
    $out[rhc] = "RHC".$ref[RHC];
    $out[name] = $ref[ProductName];
    $imgLocation = imgSrcRoot('gallery',$ref[Image]);
    $out[imgFirst] = $imgLocation.".jpg";
    $out[comingsoon] = $ref[IsSoon];
    $out[sold] = $ref[Sold];
  };
  //lite page = categories page
  if ($detail == 'lite' || 'full') {
    if ($ref[Category] == 'Fridges' ) {
        $out[chilled] = '<img src="'.imgSrcRoot('icons',$ref[Category]).'.png" />';
      } else {
        $out[chilled] = null;
      };
      if ($ref[Power] != 0 || " ") {
        $powerIconLocation = imgSrcRoot('icons',$ref[Power]).".png";
        $out[power] = file_exists ($powerIconLocation) ?
          "<img src='$powerIconLocation' />" : null;
      };
      $out[price] = $ref[Price];
      $out[sale] = $ref[IsSale];
  };
  //full = single, full categories
  if ($detail == 'full') {
    if ($ref[Brand] != "0") {
      $brandIconLocation = imgSrcRoot('icons',$ref[Brand]).".jpg";
      $out[brand] = file_exists ( $brandIconLocation ) ?
        "<img src='$brandIconLocation' />" : "Brand: ".$ref[Brand];
      $out[brandLink] = http_build_query(['page_id' => 16,
                                          'brand' => $ref[Brand]]);
    } else {
      $out[brand] = null;
      $out[brandLink] = null;
    };
    if ($ref[Wattage] > 0 && $ref[Wattage] < 1500) {
      $out[watt] = $ref[Wattage]." watts";
    } elseif ($ref[Wattage] > 1500 ) {
      $out[watt] = ($ref[Wattage] / 1000)."kw";
    } else {
      $out[watt] = null;
    };
    $out[categoryLink] = http_build_query(['page_id' => 16,
                                           'cat' => $ref[Category]]);
    $out[imgAll] = glob($imgLocation.'*');
    //TODO maybe create a mini dimension cube from these? thinking 3d css
    $out[height] = $ref[Height] != 0 ? $ref[Height] : null;
    $out[width] = $ref[Width] != 0 ? $ref[Width] : null;
    $out[depth] = $ref[Depth] != 0 ? $ref[Depth] : null;
    $out[hFull] = $ref[Height] != 0 ? $ref[Height]."mm / ".ceil($ref[Height] / 25.4)." inches" : null;
    $out[wFull] = $ref[Width] != 0 ? $ref[Width]."mm / ".ceil($ref[Width] / 25.4)." inches" : null;
    $out[dFull] = $ref[Depth] != 0 ? $ref[Depth]."mm / ".ceil($ref[Depth] / 25.4)." inches" : null;
    $out[desc] =
      ($ref['Line 1'] != " " ? $ref['Line 1']."<br>" : null).
      ($ref['Line 2'] != " " ? $ref['Line 2']."<br>" : null).
      ($ref['Line 3'] != " " ? $ref['Line 3'] : null);
    $out[count] = $ref[Quantity] > 1 ? $ref[Quantity]." in Stock" : null;
    $out[model] = $ref[Model] != "0" ? "Model: ".$ref[Model] : null;
    $out[extra] = $ref[ExtraMeasurements] != " " ? $ref[ExtraMeasurements] : null;
    $out[condition] = $ref[Condition] != " " ? $ref[Condition] : null;

  }
  return $out;
}

/*
MIN

$ref[RHC],
$ref[ProductName]]);
$ref[Image];
$ref[IsSoon];
$ref[Sold];

LITE
(above+)
$ref[Category]
$ref[Power]
$ref[Price];
$ref[IsSale];

FULL
(above+)
$ref[Brand]
$ref[Wattage]
$ref[Category]
$ref[Height]
$ref[Width]
$ref[Depth]
$ref[Height]
$ref[Line1]
$ref[Line2]
$ref[Line3]
$ref[Quantity]
$ref[Model]
$ref[ExtraMeasurements]
$ref[Condition] */

?>
