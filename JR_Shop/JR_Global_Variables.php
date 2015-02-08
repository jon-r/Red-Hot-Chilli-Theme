<?php
global $itemCount, $itemCountMin, $filterDescription, $categoryFilterArr;

//how many items before pagination. Also limits "new items" page. NYI
$itemCount = 20;

//How many items before the "try elsewhere" kicks in. NYI
$itemCountMin = 4;


/*Category Text \
\ phrases for the category page
$filterDescription = [
  'new'   => 'Fresh off the workshop floor, this equipment is cleaned and ready to go.<br>
              Enquire quickly, stock can go as soon as it comes in!',

  'soon'  => 'Stock that has just entered our workshops. <br>
              If interested, *link*call*link* us today and grab a bargain as soon as its ready.',

  'sold'  => 'Don\'t worry if you were to late to get the item you wanted, there may be another soming soon <br>
              *link*call*link* us today and reserve what you need before it goes again!',

  'sale'  => 'Surplus stock, or equipment with a few extra dents.<br>
              We make sure everything works fully before going online, so get it cheap today!',

  'search' =>'Still can\'t find what you were looking for? *link*call*link* our team today and see if we can help'
];*/

//$featuredTbl = [
//  ['ref' => 'new', 'Name' => 'New Items', 'Url' => '?page_id=16&new=1&pg=1']
//  ['ref' => 'soon', 'Name' => 'Coming Soon', 'Url' => '?page_id=16&new=1&pg=1']
//  ]
//]

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
  return '<img src="'.site_url().'/images/'.$itemType.'/'.$itemName.'.'.$filetype.'" />';
}

function imgSrcURL($itemType,$itemName) {
  return site_url().'/images/'.$itemType.'/'.$itemName;
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
