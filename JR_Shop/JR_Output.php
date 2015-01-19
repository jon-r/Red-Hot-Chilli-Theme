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
        rhc         => "RHCs".$ref[RHCs],
        name        => $ref[ProductName],
        // need to generate ss image location. would help in shop too.
        imgFirst    => imgSrcRoot('gallery',$ref[Image],'jpg'),
        price       => $ref[Price],
        feet        => $ref[TableinFeet]
      ];
      break;
    case 'full':
      $brandIconLocation = imgSrcRoot('icons',$ref[Brand],'jpg');
      switch ($ref[Brand]) {
        case file_exists ($brandIconLocation):
          $brandCheck = $brandIconLocation;
          break;
        case $ref[Brand] :
          $brandCheck = "Brand: ".$ref[Brand];
          break;
        default;
          $brandCheck = null;
      }
      if ($ref[Wattage] >= 1500) {
        $wattCheck = ($ref[Wattage] / 1000)."kw";
      } elseif ($ref[Wattage] < 1500 && $ref[Wattage] > 0) {
        $wattCheck = $ref[Wattage]." watts";
      } else {
        $wattCheck = null;
      }
      $out1 = [
        height      => $ref[Height] ?: null,
        width       => $ref[Width] ?: null,
        depth       => $ref[Height] ?: null,
        hFull       => $ref[Height] ? $ref[Height]."mm / ".ceil($ref[Height] / 25.4)." inches" : null,
        wFull       => $ref[Width] ? $ref[Width]."mm / ".ceil($ref[Width] / 25.4)." inches" : null,
        dFull       => $ref[Depth] ? $ref[Depth]."mm / ".ceil($ref[Depth] / 25.4)." inches" : null,
        desc        => ($ref['Line 1'] != " " ? $ref['Line 1']."<br>" : null).
                      ($ref['Line 2'] != " " ? $ref['Line 2']."<br>" : null).
                      ($ref['Line 3'] != " " ? $ref['Line 3'] : null),
        quantity    => $ref[Quantity] > 1 ? $ref[Quantity]." in Stock" : null,
        model       => $ref[Model],
        extra       => $ref[ExtraMeasurements],
        condition   => $ref[Condition] != " " ? $ref[Condition] : null,
        brand       => $brandCheck,
        watt        => $wattCheck,
        categoryLink => http_build_query(['page_id' => 16, 'cat' => $ref[Category]]),
        imgAll      => glob('wp-content/uploads/gallery/'.$ref[Image].'*')
      ];

    case 'med':
      $catArray = [ $ref[Category], $ref[cat1], $ref[cat2], $ref[cat3] ];
      if (in_array('Fridges', $catArray)) {
        $iconCheck = imgSrcRoot('icons','fridge','png');
      } elseif (in_array('Freezers', $catArray)) {
        $iconCheck = imgSrcRoot('icons','freezer','png');
      } elseif ($ref[Power]) {
        $iconCheck = imgSrcRoot('icons',$ref[Power],'png');
      };


      $out2 = [
        //fridge      => in_array('Fridges', $catArray) ? imgSrcRoot('icons','fridge','png'): null,
        //freezer     => in_array('Freezers', $catArray) ? imgSrcRoot('icons','freezer','png'): null,
        //power       => ($ref[Power] != 0 || " ") ? imgSrcRoot('icons',$ref[Power],'png'): null,
        icon        => $iconCheck,
        price       => $ref[Price],
     //   sale        => $ref[IsSale]
      ];
    case 'min':
      if ($ref[IsSoon]) {
        $infoCheck = "Coming Soon";
      } elseif ($ref[isSale]) {
        $infoCheck = "Sale";
      } elseif ($ref[Sold]) {
        $infoCheck = "Sold";
      };
      $out3 = [
        webLink     => http_build_query(
          ['page_id' => 21, 'r' => $ref[RHC], 'n' => $ref[ProductName]]),
        rhc         => "RHC".$ref[RHC],
        name        => $ref[ProductName],
        imgFirst    => imgSrcRoot('gallery',$ref[Image],'jpg'),
        info        => $infoCheck
       // comingsoon  => $ref[IsSoon],
       // sold        => $ref[Sold]
      ];
    };

  $out = array_merge ($out1,$out2,$out3);

  return $out;
};

?>
