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
      if ($ref[Quantity] == 0) {
        $priceCheck = 'Sold';
      } elseif ($ref[Price]) {
        $priceCheck = "£".$ref[Price]." + VAT";
      } else {
        $priceCheck = "Price Coming Soon";
      }

      $out2 = [
        webLink     => "rhcs/$ref[RHC]/$ref[ProductName]",
        //http_build_query(['page_id' => jr_page('item'), 'cat' => $ref[Category], 'r' => $ref[RHCs], 'n' => $ref[ProductName], 'x' => 1]),
        rhc         => "Ref: RHCs".$ref[RHCs],
        name        => $ref[ProductName],
        imgFirst    => imgSrcRoot('gallery',$ref[Image],'jpg'),
        price       => $priceCheck ,
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
      if ($ref[Quantity] == 0) {
        $priceCheck = '- Sold -';
      } elseif ($ref[Price]) {
        $priceCheck = "£".$ref[Price]." + VAT";
      } else {
        $priceCheck = "Price Coming Soon";
      }
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
      } elseif ($ref[Quantity] == 0) {
        $infoCheck = "sold";
      } elseif (in_array($ref[RHC], jr_query_new())) {
        $infoCheck = "new";
      }
      $out2 = [
        icon        => $iconCheck,
        price       => $priceCheck ,
        webLink     => "rhc/$ref[RHC]/$ref[ProductName]",
        //http_build_query(['page_id' => jr_page('item'), 'cat' => $ref[Category], 'r' => $ref[RHC], 'n' => $ref[ProductName]]),
        rhc         => "ref: RHC$ref[RHC]",
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

// ---------------------- items list setup ----------------------------------------------
// figures out what to show on output page, based on safeArr and the page number

function jr_items_list_check($safeArr,$pageNumber) {
  global $itemCountMax;

  //the full list query will always be the same, since this function is preset to cap at one page
  $listUnsold = jr_category_filter($safeArr, $pageNumber);
  $out['paginate'] = false;
  $lastPage = 1;

  if ($safeArr['pgType'] != 'New' || $safeArr['pgType'] != 'Sold') {
    //the "sold" and "new" already capped at a single page, no need to count

    $fullItemCount = jr_cat_count($safeArr);

    //breaks down into pages
    if ($fullItemCount > $itemCountMax) {
      $out['paginate'] = $lastPage = intval(ceil($fullItemCount / $itemCountMax));
    }

    //fills up the last page with sold items
    if ($pageNumber == $lastPage) {
      $itemsOnLastPage = $fullItemCount % $itemCountMax;
      $listSold = jr_cat_sold($safeArr, $itemsOnLastPage);

    }
  }

  $out['list'] = $listSold ? array_merge($listUnsold, $listSold) : $listUnsold;

 // $out['debug'] = $fullItemCount;

  return $out;

}

// ----------------------3d scaler ------------------------------------------------------
// gives relative sizes of HxWxD for items page. also "average man" to scale

function jr_box_3d($h, $w, $d) {

  $manHeight = 1750; //average male height in mm
  $findMax = max($h, $w, $d, $manHeight);

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
    $link = http_build_query(['cat' => $_GET[cat], 'page_id' => jr_page('cat')]);
    $crumbs[1] = [$_GET[cat] => site_url()."/?".$link];
    $crumbs[2] = [$safeArr[pgName] => getUrl()];
  } else {
    $crumbs[1] = [$safeArr[pgName] => jr_pg_set()];
  };

//  $crumbs['new'] = $_GET[$page_id];
  return $crumbs;
}

// ----------------------pg-clips--------------------------------------------------------
// tweaks the 'pg' number from page urls. specifically for category page navigation
// can produce numbers outside range (eg page 0) paginate links should be hidden on front end if at max/min

function jr_pg_set ($pgSet = null, $pgCap = 1) {
  $url = strtok(getUrl(), '?');
  $arrParams = $_GET;
  if (is_int($pgSet)) {
    $arrParams['pg'] = $pgSet;
  } elseif ($pgSet == 'plus') {
    $arrParams['pg'] ? $arrParams['pg']++ : $arrParams['pg'] = 2;
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

// ---------------------- carousel compiler --------------------------------------
// converts the database carousel to a web one
// takes the carousel "link" and converts it to a sale if it is just a number. else treats it like a link



function jr_position($in) {
  if ($in == "Middle") {
    $out = "go-mid";
  } elseif ($in == "Left") {
    $out = "go-left";
  } elseif ($in == "Right") {
    $out = "go-right";
  }

  return $out;
}

function jr_style($in) {
  if ($in == "Bold") {
    $out = "go-bold";
  } elseif ($in == "Red") {
    $out = "go-red";
  } elseif ($in == "Bold_Red") {
    $out = "go-bold go-red";
  } else {
    $out = null;
  }

  return $out;
}

//because descriptive function names are too mainstream
function magic_roundabout($slideIn) {
  $out = [
    title     => $slideIn[Title],
    titlePos  => jr_position($slideIn[TitlePos]),
    text1     => $slideIn[Description] != "0" ? $slideIn[Description] : null,
    text2     => $slideIn[Desc2] != "0" ? $slideIn[Desc2] : null,
    text3     => $slideIn[Desc3] != "0" ? $slideIn[Desc3] : null,
    textPos   => jr_position($slideIn[TextPos]),
    style1    => jr_style($slideIn[Desc1Emphasis]),
    style2    => jr_style($slideIn[Desc2Emphasis]),
    style3    => jr_style($slideIn[Desc3Emphasis]),
    image     => imgSrcRoot(carousel,$slideIn[ImageRef],jpg),
    link      => is_numeric($slideIn[WebLink]) ? "?page_id=16&sale=$slideIn[WebLink]" : $slideIn[WebLink],
    linkPos   => jr_position($slideIn[ClickHerePos])
  ];

  return $out;
}

//-------------- pick testimonial -----------------------------------------------
// grabs a single testimonial at random

function jr_random_feedback() {
  $in = jr_query_tesimonial();
  $countIn = count($in) - 1;
  $random = rand(0,$countIn);

  return $in[$random];
}


?>


