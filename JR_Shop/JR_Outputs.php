<?php


// ----------------------array compiler--------------------------------------------------
// Converts raw databases (associative) into useful blocks of text

function jr_shop_compile($ref,$detail) {
  global $rhcListNew;
  $out1 = $out2 = []; //need to declare empty arrays
  switch ($detail) {
    case 'ssFull' :
      $out1 = [
        height      => $ref[Height] ?: null,
        width       => $ref[Width] ?: null,
        depth       => $ref[Depth] ?: null,
        hFull       => $ref[Height] ? "Height: ".$ref[Height]."mm / ".ceil($ref[Height] / 25.4)." inches" : null,
        wFull       => $ref[Width] ? "Width: ".$ref[Width]."mm / ".ceil($ref[Width] / 25.4)." inches" : null,
        dFull       => $ref[Depth] ? "Depth: ".$ref[Depth]."mm / ".ceil($ref[Depth] / 25.4)." inches" : null,
        desc        => ($ref['Line1'] != " " ? $ref['Line 1']."<br>" : null),
        quantity    => $ref[Quantity] > 1 ? $ref[Quantity]." in Stock" : null
      ];
    case 'stainless':
      $out2 = [
        webLink     => http_build_query(
          ['page_id' => jr_page('item'), 'cat' => $ref[Category], 'r' => $ref[RHCs], 'n' => $ref[ProductName], 'x' => 1]),
        rhc         => "Ref: RHCs".$ref[RHCs],
        name        => $ref[ProductName],
        imgFirst    => imgSrcRoot('gallery',$ref[Image],'jpg'),
        price       => $ref[Price] ? "£".$ref[Price]." + VAT" : "Price Coming Soon" ,
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
        height      => $ref[Height] ?: null,
        width       => $ref[Width] ?: null,
        depth       => $ref[Depth] ?: null,
        hFull       => $ref[Height] ? "Height: ".$ref[Height]."mm / ".ceil($ref[Height] / 25.4)." inches" : null,
        wFull       => $ref[Width] ? "Width: ".$ref[Width]."mm / ".ceil($ref[Width] / 25.4)." inches" : null,
        dFull       => $ref[Depth] ? "Depth: ".$ref[Depth]."mm / ".ceil($ref[Depth] / 25.4)." inches" : null,
        desc        => ($ref['Line 1'] != " " ? $ref['Line 1']."<br>" : null).
                      ($ref['Line 2'] != " " ? $ref['Line 2']."<br>" : null).
                      ($ref['Line 3'] != " " ? $ref['Line 3'] : null),
        model       => $ref[Model] ? "Model: ".$ref[Model] : null,
        extra       => $ref[ExtraMeasurements],
        condition   => $ref[Condition] != " " ? $ref[Condition] : null,
        brand       => $brandCheck,
        watt        => $wattCheck,
        imgAll      => glob('images/gallery/'.$ref[Image].'*')
      ];
    case 'med':
      $catArray = [ $ref[Category], $ref[cat1], $ref[cat2], $ref[cat3] ];
      if (in_array('Fridges', $catArray) && in_array('Freezers', $catArray)) {
        $iconCheck = 'fridge-freezer';
      } elseif (in_array('Fridges', $catArray)) {
        $iconCheck = 'fridge';
      } elseif (in_array('Freezers', $catArray)) {
        $iconCheck = 'freezer';
      } elseif ($ref[Power]) {
        $iconCheck = str_replace(' ', '-', strtolower($ref[Power]));
      };
      if ($ref[IsSoon]) {
        $infoCheck = "soon";
      } elseif ($ref[isSale]) {
        $infoCheck = "sale";
      } elseif ($ref[Sold]) {
        $infoCheck = "sold";
      } elseif (in_array($ref[RHC], $rhcListNew)) {
        $infoCheck = "new";
      }
      $out2 = [
        icon        => $iconCheck,
        price       => $ref[Price] ? "£".$ref[Price]." + VAT" : "Price Coming Soon" ,
        webLink     => http_build_query(
          ['page_id' => jr_page('item'), 'cat' => $ref[Category], 'r' => $ref[RHC], 'n' => $ref[ProductName]]),
        rhc         => "ref: RHC".$ref[RHC],
        name        => $ref[ProductName],
        imgFirst    => imgSrcRoot('gallery',$ref[Image],'jpg'),
        info        => $infoCheck,
        quantity    => $ref[Quantity] > 1 ? $ref[Quantity]." in Stock" : null
      ];
    break;
  };

  $out = array_merge ($out1,$out2);

  return $out;
};
// ----------------------3d scaler ------------------------------------------------------
// gives relative sizes of HxWxD for items page. also "average man" to scale

function jr_box_3d($h, $w, $d) {
  $manHeight = 1750;
  $findMax = max($h, $w, $d,$manHeight);

  $out = [
    height  => ceil($h / $findMax * 100),
    width   => ceil($w / $findMax * 100),
    depth   => ceil($d / $findMax * 100),
    man     => ceil($manHeight / $findMax * 100)
  ];

  return $out;
}



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
    $crumbs[1] = [$safeArr[pgName] => jr_pg_set()];
  };

//  $crumbs['new'] = $_GET[$page_id];
  return $crumbs;
}

// ----------------------pg-clips--------------------------------------------------------
// tweaks the 'pg' number from page urls. specifically for category page navigation
// can produce numbers outside range. paginate links should be hidden if at max/min

function jr_pg_set ($pgSet = null, $pgCap = 1) {
  $url = strtok(getUrl(), '?');
  $arrParams = $_GET;
  if (is_int($pgSet)) {
    $arrParams['pg'] = $pgSet;
  } elseif ($pgSet == 'plus') {
    $arrParams['pg'] <= $pgCap ? $arrParams['pg']++ : $arrParams['pg'];
  } elseif ($pgSet == 'minus') {
    $arrParams['pg'] > 1 ? $arrParams['pg']-- : $arrParams['pg'];
  } else {
    unset($arrParams['pg']);
  }

  $urlQueries = http_build_query($arrParams);
  return $url.'?'.$urlQueries;
}

// gets the current page, taking into account no pg value = 1
function jr_is_pg($pgNum) {
  $getPg = $_GET['pg'] ? $_GET['pg'] : 1;
  return $getPg == $pgNum ? true : false;
}

// ----------------------image-manipulation----------------------------------------------
// generates resized images. Maybe put the "image remove" here too?


// to be load on first requirement, does nothing once the file has been made.
//this also (conveniently) used to dump the "coming soon"
function img_resize ($src, $size) {
  $img = wp_get_image_editor( $src );
  $newSrc = str_replace("gallery", "gallery-$size", $src);
  $reSize = imgSize($size);
  $out = $newSrc;
  if (file_exists($newSrc) && file_exists($src)) {
    $dateCheck = filemtime($newSrc) < filemtime($src);
    if ($dateCheck) {
      $img->resize( $reSize, $reSize, false );
      $img->set_quality( 80 );
      $img->save($newSrc);
    }
  } elseif (file_exists($src)) {
    $img->resize( $reSize, $reSize, false );
    $img->set_quality( 80 );
    $img->save($newSrc);
  } else {
    $out = imgSrcRoot(icons,ComingSoon,jpg);
  }

  return $out;
}



?>


