<?php



// ----------------------array compiler--------------------------------------------------
// Converts raw databases (associative) into useful "chunks" of text

function jr_shop_compile($ref,$detail) {
  $out1 = $out2 = []; //need to declare empty arrays
  switch ($detail) {
    case 'ssFull' :
      $out1 = [
  //      height      => $ref[Height] ?: null,
  //      width       => $ref[Width] ?: null,
  //      depth       => $ref[Height] ?: null,
        hFull       => $ref[Height] ? $ref[Height]."mm / ".ceil($ref[Height] / 25.4)." inches" : null,
        wFull       => $ref[Width] ? $ref[Width]."mm / ".ceil($ref[Width] / 25.4)." inches" : null,
        dFull       => $ref[Depth] ? $ref[Depth]."mm / ".ceil($ref[Depth] / 25.4)." inches" : null,
        desc        => ($ref['Line1'] != " " ? $ref['Line 1']."<br>" : null),
        quantity    => $ref[Quantity] > 1 ? $ref[Quantity]." in Stock" : null
      ];
    case 'stainless':
      $out2 = [
        webLink     => http_build_query(
          ['page_id' => jr_page('item'), 'cat' => $ref[Category], 'r' => $ref[RHCs], 'n' => $ref[ProductName], 'x' => 1]),
        rhc         => "RHCs".$ref[RHCs],
        name        => $ref[ProductName],
        // need to generate ss image location. would help in shop too.
        imgFirst    => imgSrcRoot('gallery',$ref[Image],'jpg'),
        price       => $ref[Price],
        icon       => $ref[TableinFeet].'ft'
      ];
    break;
    case 'full':
      $brandIconLocation = imgSrcRoot('icons',$ref[Brand],'jpg');
      if (file_exists ($brandIconLocation)) {
        $brandCheck = $brandIconLocation;
      } elseif ($ref[Brand]) {
        $brandCheck = "Brand: ".$ref[Brand];
      } else {
        $brandCheck = null;
      };
      if ($ref[Wattage] >= 1500) {
        $wattCheck = ($ref[Wattage] / 1000)."kw";
      } elseif ($ref[Wattage] < 1500 && $ref[Wattage] > 0) {
        $wattCheck = $ref[Wattage]." watts";
      } else {
        $wattCheck = null;
      }

      $out1 = [
 //       height      => $ref[Height] ?: null,
 //       width       => $ref[Width] ?: null,
  //      depth       => $ref[Height] ?: null,
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
      if ($ref[IsSoon]) {
        $infoCheck = "<div>Coming Soon</div>";
      } elseif ($ref[isSale]) {
        $infoCheck = "<div>Sale</div>";
      } elseif ($ref[Sold]) {
        $infoCheck = "<div>Sold</div>";
      };
      $out2 = [
        icon        => $iconCheck,
        price       => $ref[Price],
        webLink     => http_build_query(
          ['page_id' => jr_page('item'), 'cat' => $ref[Category], 'r' => $ref[RHC], 'n' => $ref[ProductName]]),
        rhc         => "RHC".$ref[RHC],
        name        => $ref[ProductName],
        imgFirst    => imgSrcRoot('gallery',$ref[Image],'jpg'),
        info        => $infoCheck
      ];
    break;
  };

  $out = array_merge ($out1,$out2);

  return $out;
};

// ----------------------breadcrumb builder----------------------------------------------
// Makes the breadcrumbs

//maybe use simlar for the page titles? Or better yet, this could make the titles and then the bread gets the title
function jr_page_crumbles ($safeArr) {
  $crumbs[0] = ['Home' => home_url()];

  if ($safeArr[pgType] == 'Item') {
    $link = http_build_query(['cat' => $safeArr[cat], 'page_id' => jr_page('cat')]);
    $crumbs[1] = [$safeArr[cat] => site_url()."/?".$link];
    $crumbs[2] = [$safeArr[pgName] => getUrl()];
  } else {
    $crumbs[1] = [$safeArr[pgName] => getUrl()];
  };

//  $crumbs['new'] = $_GET[$page_id];
  return $crumbs;
}

?>
