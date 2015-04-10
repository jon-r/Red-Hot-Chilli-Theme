<?php
global $itemCountMax, $itemCountMin, $filterDescription, $categoryFilterArr, $twitterLink, $facebookLink, $linkedinLink;

//social media links.
$rhcFacebookLink = 'https://www.facebook.com/pages/Red-Hot-Chilli-Catering/147845465419524';
$rhcTwitterLink = 'https://twitter.com/RHC_Catering';
$rhcLinkedinLink = 'https://uk.linkedin.com/pub/simon-greenwood/69/b05/689';
$rhcEmail = 'info@redhotchilli.catering';
$rhcTel = '01925 242623';

//how many items before pagination. Also limits some pages.
$itemCountMax = 24;

//How many items before the "try elsewhere" kicks in. NYI
$itemCountMin = 4;

/*Category Text \
\ phrases for the category page */

function jr_category_info($catType) {
  $categoryFilterArr = [
    'New'   => 'Fresh off the workshop floor, this equipment is cleaned and ready to go.<br>
                Enquire quickly, stock can go as soon as it comes in!',
    'Soon'  => 'Stock that has just entered our workshops.<br>
                If interested, *link*call*link* us today and grab a bargain as soon as its ready.',
    'Sold'  => 'Don\'t worry if you were to late to get the item you wanted, there may be another soming soon <br>
                *link*call*link* us today and reserve what you need before it goes again!',
    'Sale'  =>  'Surplus stock, or equipment with a few extra dents.<br>
                 We make sure everything works fully before going online, so get it cheap today!',
    'Search' => 'Still can\'t find what you were looking for? *link*call*link* our team today and see if we can help',
    'All'   =>  'We buy and sell new items each week, and can\'t always keep the new site up to date.<br>
                 If there is anything in particular you are looking for, feel free to *link*call*link* us and we\'ll see what we can find.'
  ];
  return $categoryFilterArr[$catType];
}

/*img location \
\ potentially changed when proper urls are named */
function imgSrcRoot($itemType,$itemName,$filetype) {
  return 'images/'.$itemType.'/'.$itemName.'.'.$filetype;
}

//function imgSrcURL($itemType,$itemName) {
//  return 'images/'.$itemType.'/'.$itemName;
//}

//Image sizes for generated. would need to wipe gallery-thumb/gallery-tile folders if these are changed
function imgSize($size) {
  $sizeArr = [
    'thumb' => 150,
    'tile'  => 480
  ];
  return $sizeArr[$size];
}

//returns if item in group. one level deeper than the normal IN_ARRAY
function isGroup($group) {
  return function ($category) use ($group) {
    return ($category[CategoryGroup] == $group);
  };
}

function groupFilter($group) {
  global $categoriesList;
  return array_filter ($categoriesList, isGroup($group));
}

function getUrl() {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= $_SERVER["REQUEST_URI"];
  return $url;
}

?>
