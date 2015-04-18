<?php

/* SECURITY:
  > Since the Back-End is Based on in house PCs, theres a fairly limited amount that the customer can access.
  > no personal details are to be keeped on internet databases
  > Light security whitlelist sanitises the input to prevent injection just in case.
*/

//idea of this function is to act as a wall between input and output.
//the user can input whatever he wants, but only strings on this page are used
function jr_validate_params($get) {
  $out = null;

  if ($get[page_id] == null) {//home page
    $out[pgName] = $out[pgType] = 'Home';

  } elseif ($get[page_id] == jr_page('grp')) {
    $out[pgType] = 'Group';
    if ($get[g] == 'all') {
      $out[pgName] = 'All Categories';
      $out[group] = 'all';
    } else {
      $out[pgName] = $out[group] = jr_validate_group($get[g]);
      $out[imgUrl] = imgSrcRoot('icons',urlencode($out[pgName]),'jpg');
    }


  } elseif ($get[page_id] == jr_page('cat')) {
    if ($get['new']) {
      $out[pgType] = 'New';
      $out[pgName] = 'Just In';

    } elseif ($get['soon']) {
      $out[pgType] = 'Soon';
      $out[pgName] = 'Coming Soon';

    } elseif ($get['sold']) {
      $out[pgName] = $out[pgType] = 'Sold';

    } elseif ($get['sale']) {
      $out[pgType] = 'Sale';
      $out[pgName] = 'Special Offers';

    } elseif ($get['search']) {
      $out[pgType] = 'Search';
      $out[search] = jr_validate_search($get['search']);
      $readableSearch = preg_replace("/[^[:alnum:][:space:]]/ui", ' ', $get['search']);
      $out[pgName] = 'Search Results for \''.$readableSearch.'\'';

    } elseif ($get['brand']) {
      $out[pgType] = 'Brand';
      $out[brand] =  jr_validate_brand($get['brand']);
      $out[pgName] = 'Products from '.$out[brand];
      $brandIconLocation = imgSrcRoot('icons',$out[brand],'jpg');
      if (file_exists ($brandIconLocation)) {
        $out[imgUrl] = $brandIconLocation;
      };

    } elseif ($get['cat'] && !jr_validate_stainless($get['cat'])) {
      $out[pgType] = 'Category';
      $out[pgName] = $out[cat] = jr_validate_category($get['cat']);

    } elseif (jr_validate_stainless($get['cat'])) {
      $out[pgType] = 'CategorySS';
      $out[pgName] = $out[cat] = jr_validate_category($get['cat']);

    } else {
      $out[pgType] = 'All';
      $out[pgName] = 'All Products';
    };
    if ($out[pgType] == 'Category' || $out[pgType] == 'CategorySS') {
      $out[imgUrl] = imgSrcRoot('thumbnails',$fCategory,'jpg');
      $categoryDetails = jr_category_row( $fCategory );
      $out[description] = $categoryDetails[CategoryDescription] ?: null;
    } else {
      $out[description] = jr_category_info($out[pgType]);

    }
  } elseif ($get[page_id] == jr_page('item')) {
    $out[pgType] = 'Item';
    $out[rhc] = $get['x'] ? jr_validate_rhcs($get['r']) : jr_validate_rhc($get['r']);
    $out[cat] = jr_validate_category($get['cat']);
    $out[ss] = $get['x'] ? true : false;
    $out[pgName] = $get['n'];

  } else {
    $out[pgType] = $out[pgName] = 'Page Name'; //get the page title
  };

  return $out;
}

/*--------------------------------------------------------------------------------------*/













//new version works on permalinks...
function jr_validate_urls($url) {
  $slashedParams = str_replace(site_url(), '', $url);
  $params = explode('/',$slashedParams);
  $out = null;

  if ($params[1] == '') {
    $out[pgName] = $out[pgType] = 'Home';

  } elseif ($params[1]  == 'departments') {
    $out[pgType] = 'Group';
    if ($params[2] == 'all') {
      $out[pgName] = 'All Categories';
      $out[group] = 'all';
    } else {
      $out[pgName] = $out[group] = jr_validate_group($params[2]);
      $out[imgUrl] = imgSrcRoot('icons',urlencode($out[pgName]),'jpg');
    }


  } elseif ($params[1] == 'products') {
    if ($params[2] == 'all') {
      $out[pgType] = 'All';
      $out[pgName] = 'All Products';
    } elseif (jr_validate_stainless($params[2])) {
      $out[pgType] = 'CategorySS';
      $out[pgName] = $out[cat] = jr_validate_category($params[2]);
    } else {
      $out[pgType] = 'Category';
      $out[pgName] = $out[cat] = jr_validate_category($params[2]);
    }

  } elseif ($params[1] == 'new-items') {
    $out[pgType] = 'New';
    $out[pgName] = 'Just In';

  } elseif ($params[1] == 'coming-soon') {
    $out[pgType] = 'Soon';
    $out[pgName] = 'Coming Soon';

  } elseif ($params[1] == 'sold') {
    $out[pgName] = $out[pgType] = 'Sold';

  } elseif ($params[1] == 'sale') {
    $out[pgType] = 'Sale';
    $out[pgName] = 'Special Offers';
    $out[saleNum] = $params[2];

  } elseif ($params[1] == 'search') {
    $out[pgType] = 'Search';
    $out[search] = jr_validate_search($params[2]);
    $readableSearch = preg_replace("/[^[:alnum:][:space:]]/ui", ' ', $params[2]);
    $out[pgName] = 'Search Results for \''.$readableSearch.'\'';

  } elseif ($params[1] == 'brand') {
    $out[pgType] = 'Brand';
    $out[brand] =  jr_validate_brand($params[2]);
    $out[pgName] = 'Products from '.$out[brand];
    $brandIconLocation = imgSrcRoot('icons',$out[brand],'jpg');
    if (file_exists ($brandIconLocation)) {
      $out[imgUrl] = $brandIconLocation;
    };


//    if ($out[pgType] == 'Category' || $out[pgType] == 'CategorySS') {
//      $out[imgUrl] = imgSrcRoot('thumbnails',$fCategory,'jpg');
//      $categoryDetails = jr_category_row( $fCategory );
//      $out[description] = $categoryDetails[CategoryDescription] ?: null;
//    } else {
//      $out[description] = jr_category_info($out[pgType]);
//    }

  } elseif ($params[1] == 'rhc') { //product
    $out[pgType] = 'Item';
    $out[rhc] = jr_validate_rhc($params[2]);
    $out[ss] = $get['x'] ? true : false;
    $out[pgName] = $params[3];

  } elseif ($params[1] == 'rhcs') { //product-ss
    $out[pgType] = 'Item';
    $out[rhc] = jr_validate_rhcs($params[2]);
    $out[ss] = true;
    $out[pgName] = $params[3];
  } else {
    $out[pgType] = $out[pgName] = 'Page Name'; //get the page title
  };

  return $out;
};

//-------------------------------

//validates group
function jr_validate_group($rawGroup) {
  global $getGroup;
  return in_array($rawGroup, $getGroup) ? $rawGroup : null;
}

//validates categories, makes sure exists
function jr_validate_category($rawCategory) {
  $categoriesListColumn = jr_query_col_unique('name', 'rhc_categories');
  return in_array($rawCategory, $categoriesListColumn) ? $rawCategory : null ;
};

//validates stainless pages,
//returns TRUE/FALSE (this is only being used as a switch between stainless and standard product tables)
function jr_validate_stainless($rawStainless) {
  $stainlessList = jr_query_keywords('stainless');
  return in_array($rawStainless, $stainlessList);
};

//validates brands.
//note this is vs ALL brands in the db, not just the 'major' brand keywords
function jr_validate_brand($rawBrand) {
 // global $brandsListFull;
  $brandsListFull = jr_query_col_unique('Brand', 'networked db');
  return in_array(ucwords($rawBrand), $brandsListFull) ? ucwords($rawBrand) : null;
};

//validatesRHC
function jr_validate_rhc($rawRHC) {
  $rhcColumn = jr_query_col_unique('rhc', 'networked db');
  return in_array($rawRHC, $rhcColumn) ? $rawRHC : null;
};

//validatesRHCs
function jr_validate_rhcs($rawRHC) {
  $rhcsColumn = jr_query_col_unique('rhcs', 'benchessinksdb');
  return in_array($rawRHC, $rhcsColumn) ? $rawRHC : null;
};

/*
*  sanitises the search, accepting only alphanumeric , replacing everything esle with a "?".
*  The goal is that if its a legit symbol in the search (eg. ',&,-) then a '?' will still pick them up in the regexp search.
*  If its not a legit symbol (eg. mysql injection) then the ? will wipe out all dangerous options.
*  This happens after the "smart auto complete" since they all vailidate against actual data
*/

function jr_validate_search($rawSearch) {
  return preg_replace("/[^[:alnum:][:space:]]/ui", '.?', $rawSearch);
};


?>
