<?php

/* SECURITY:
  > Since the Back-End is Based on in house PCs, theres a fairly limited amount that the customer can access.
  > no personal details are to be keeped on internet databases
  > Light security whitlelist sanitises the input to prevent injection just in case.
*/

/*--------------------------------------------------------------------------------------*/


//idea of this function is to act as a wall between input and output.
//the user can input whatever he wants, but only strings on this function are used in sql queries
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
      $out[pgName] = $out[group] = url_to_title($params[2],'grp');
      $out[imgUrl] = imgSrcRoot('icons',urlencode($out[pgName]),'jpg');
    }


  } elseif ($params[1] == 'products') {

    $out[pgName] = $out[cat] = url_to_title($params[2],'cat');
    $out[imgUrl] = imgSrcRoot('thumbnails',$out[pgName],'jpg');
    $categoryDetails = jr_category_row( $out[pgName] );
    $out[description] = $categoryDetails[CategoryDescription] ?: null;

    if ($params[2] == 'all') {
      $out[pgType] = 'All';
      $out[pgName] = 'All Products'; //everything

    } elseif ($params[2] == 'search') {
      $out[pgType] = 'Search';
      $out[search] = str_replace(' ', '|', $_GET[q]);
    //  $readableSearch = esc_url($params[3]);
      $out[pgName] = 'Search Results for \''.$_GET[q].'\'';

    } elseif (jr_validate_stainless($out[pgName])) {
      $out[pgType] = 'CategorySS'; //category stainless

    } else {
      $out[pgType] = 'Category'; //category
    }

  } elseif ($params[1] == 'new-items') { //new in
    $out[pgType] = 'New';
    $out[pgName] = 'Just In';

  } elseif ($params[1] == 'coming-soon') { //soon
    $out[pgType] = 'Soon';
    $out[pgName] = 'Coming Soon';

  } elseif ($params[1] == 'sold') { //sold
    $out[pgName] = $out[pgType] = 'Sold';

  } elseif ($params[1] == 'sale') { //sale
    $out[pgType] = 'Sale';
    $out[pgName] = 'Special Offers';
    $out[saleNum] = $params[2];

  } elseif ($params[1] == 'brand') { //brand
    $out[pgType] = 'Brand';
    $out[brand] =  jr_validate_brand($params[2]);
    $out[pgName] = 'Products from '.$out[brand];
    $brandIconLocation = imgSrcRoot('icons',$out[brand],'jpg');
    if (file_exists ($brandIconLocation)) {
      $out[imgUrl] = $brandIconLocation;
    };

  } elseif ($params[1] == 'rhc') { //product
    if (jr_query_rhc($params[2])) {
      $getItem = jr_query_titles($params[2]);
      $out[rhc] = $params[2];
      $out[pgName] = $getItem[ProductName];
      $out[cat] = $getItem[Category];
      $out[ss] = false;
    } else {
      $out[noitem] = true;
    }

    $out[pgType] = 'Item';

  } elseif ($params[1] == 'rhcs') { //product-ss
    if (jr_query_rhcs($params[2])) {
      $getItem = jr_query_titles($params[2], $SS = true);
      $out[rhc] = $params[2];
      $out[ss] = true;
      $out[pgName] = $getItem[ProductName];
      $out[cat] = $getItem[Category];
    } else {
      $out[noitem] = true;
    }
    $out[pgType] = 'Item';
    $out[note] = 'GET IMAGES BACK IN';

  } else {
    $out[pgType] = $out[pgName] = get_the_title();//get the page title
  };

  return $out;
};

//-------------------------------

//validates stainless pages,
//returns TRUE/FALSE (this is only being used as a switch between stainless and standard product tables)
function jr_validate_stainless($rawStainless) {
  $stainlessList = jr_query_keywords('stainless');
  return in_array($rawStainless, $stainlessList);
};

//validates brands.
//note this is vs ALL brands in the db, not just the 'major' brand keywords
function jr_validate_brand($rawBrand) {
  $brandsListFull = jr_query_col_unique('Brand', 'networked db');
  return in_array(ucwords($rawBrand), $brandsListFull) ? ucwords($rawBrand) : null;
};


?>
