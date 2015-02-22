<?php

/* SECURITY:
  > Since the Back-End is Based on in house PCs, theres a fairly limited amount that the customer can access.
  > no personal details are to be keeped on internet databases
  > Light security whitlelist sanitises the input to prevent injection just in case.
*/
function jr_validate_params($get) {
  $out = null;

  if ($get[page_id] == null) {//home page
    $out[pgName] = $out[pgType] = 'Home';

  } elseif ($get[page_id] == jr_page('grp')) {
    $out[pgType] = 'Group';
    $out[pgName] = $out[group] = jr_validate_group($get[g]);
    $out[imgUrl] = imgSrcRoot('icons',urlencode($out[pgName]),'jpg');

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
    $out[rhc] = $get['x'] ? jr_validate_rhc($get['r']) : jr_validate_rhc($get['r']);
    $out[cat] = jr_validate_category($get['cat']);
    $out[ss] = $get['x'] ?: false;
    $out[pgName] = $get['n'];

  } else {
    $out[pgType] = $out[pgName] = 'Page Name'; //get the page title
  };

  return $out;
}

//-------------------------------

//validates keywords
function jr_validate_keywords($rawIn) {
  global $keywords;
  return in_array($rawIn, $keywords) ?: $rawIn;
}

//validates group
function jr_validate_group($rawGroup) {
  global $groupsList;
  return in_array($rawGroup, $groupsList) ? $rawGroup : null;
}

//validates categories, makes sure exists
function jr_validate_category($rawCategory) {
  global $categoriesListColumn;
  return in_array($rawCategory, $categoriesListColumn) ? $rawCategory : null ;
};

//validates stainless pages,
//returns TRUE/FALSE (this is only being used as a switch between stainless and standard product tables)
//TODO, check for RHCs
function jr_validate_stainless($rawStainless) {
  global $stainlessList;
  return in_array($rawStainless, $stainlessList);
};

//validates brands.
//note this is vs ALL brands in the db, not just the 'major' brand keywords
function jr_validate_brand($rawBrand) {
  global $brandsListFull;
  return in_array(ucwords($rawBrand), $brandsListFull) ? ucwords($rawBrand) : null;
};

//validatesRHC
function jr_validate_rhc($rawRHC) {
  global $rhcColumn;
  return in_array($rawRHC, $rhcColumn) ? $rawRHC : null;
};

//validatesRHCs
function jr_validate_rhcs($rawRHC) {
  global $rhcsColumn;
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
