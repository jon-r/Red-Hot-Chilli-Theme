<?php

// ----------------------array compiler-----------------------------------------------------------
// Converts raw databases into useful "chunks" of text
//$ref = associative array generated from the database/filters
//new plan: keep this function as minimal as possible, returning just minimal strings. do the design in the templates
function jr_shop_compile($ref,$detail) {
  $out1 = $out2 = $out3 = []; //need to declare empty arrays
  switch ($detail) {
    case 'stainless':
      $out1 = [
        //need to consider "stainless full"
        webLink     => http_build_query(
          ['page_id' => 21, 'r' => $ref[RHCs], 's' => 1, 'n' => $ref[ProductName]]),
        rhcs        => "RHCs".$ref[RHCs],
        name        => $ref[ProductName],
        // need to generate ss image location. would help in shop too.
        imgFirst    => imgSrcRoot('gallery',$ref[Image],'jpg'),
        price       => $ref[Price],
        feet        => $ref[TableinFeet]
      ];
      break;
    case 'full':
      $out1[height] =   $ref[Height] != 0 ? $ref[Height] : null;
      $out1[width] =    $ref[Width] != 0 ? $ref[Width] : null;
      $out1[depth] =    $ref[Depth] != 0 ? $ref[Depth] : null;
      $out1[hFull] =    $ref[Height] != 0 ? $ref[Height]."mm / ".ceil($ref[Height] / 25.4)." inches" : null;
      $out1[wFull] =    $ref[Width] != 0 ? $ref[Width]."mm / ".ceil($ref[Width] / 25.4)." inches" : null;
      $out1[dFull] =    $ref[Depth] != 0 ? $ref[Depth]."mm / ".ceil($ref[Depth] / 25.4)." inches" : null;
      $out1[desc] =     ($ref['Line 1'] != " " ? $ref['Line 1']."<br>" : null).
                        ($ref['Line 2'] != " " ? $ref['Line 2']."<br>" : null).
                        ($ref['Line 3'] != " " ? $ref['Line 3'] : null);
      $out1[count] =    $ref[Quantity] > 1 ? $ref[Quantity]." in Stock" : null;
      $out1[model] =    $ref[Model] != "0" ? "Model: ".$ref[Model] : null;
      $out1[extra] =    $ref[ExtraMeasurements] != " " ? $ref[ExtraMeasurements] : null;
      $out1[condition] = $ref[Condition] != " " ? $ref[Condition] : null;
      if ($ref[Brand] != "0") {
        $brandIconLocation = imgSrcRoot('icons',$ref[Brand],'jpg');
        $out1[brand] = file_exists ( $brandIconLocation ) ? $brandIconLocation : "Brand: ".$ref[Brand];
        $out1[brandLink] = http_build_query(['page_id' => 16, 'brand' => $ref[Brand]]);
      };
      if ($ref[Wattage] > 0 && $ref[Wattage] < 1500) {
        $out1[watt] = $ref[Wattage]." watts";
      } elseif ($ref[Wattage] > 1500 ) {
        $out1[watt] = ($ref[Wattage] / 1000)."kw";
      };
      $out1[categoryLink] = http_build_query(['page_id' => 16, 'cat' => $ref[Category]]);
      $out1[imgAll] =   glob(imgSrcURL('gallery',$ref[Image]).'*');
      //TODO maybe create a mini dimension cube from these? thinking 3d css

    case 'med':
      $catArray = [ $ref[Category], $ref[cat1], $ref[cat2], $ref[cat3] ];
      $out2 = [
        fridge      => in_array('Fridges', $catArray) ? imgSrcRoot('icons','fridge','png'): null,
        freezer     => in_array('Freezers', $catArray) ? imgSrcRoot('icons','freezer','png'): null,
        power       => ($ref[Power] != 0 || " ") ? imgSrcRoot('icons',$ref[Power],'png'): null,
        price       => $ref[Price],
        sale        => $ref[IsSale]
      ];
    case 'min':
      $out3 = [
        webLink     => http_build_query(
          ['page_id' => 21, 'r' => $ref[RHC], 'n' => $ref[ProductName]]),
        rhc         => "RHC".$ref[RHC],
        name        => $ref[ProductName],
        imgFirst    => imgSrcRoot('gallery',$ref[Image],'jpg'),
        comingsoon  => $ref[IsSoon],
        sold        => $ref[Sold]
      ];
    };

  $out = array_merge ($out1,$out2,$out3);

  return $out;
}

?>
