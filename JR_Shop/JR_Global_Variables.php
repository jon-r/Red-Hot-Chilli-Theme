<?php
global $itemCount, $itemCountMin;

//how many items before pagination. Also limits "new items" page. NYI
$itemCount = 20;

//How many items before the "try elsewhere" kicks in. NYI
$itemCountMin = 4;

/*img location \
\ potentially changed when proper urls are named */
function imgSrcRoot($itemType,$itemName,$filetype) {
  return '<img src="'.site_url().'/wp-content/uploads/'.$itemType.'/'.$itemName.'.'.$filetype.'" />';
}

function imgSrcURL($itemType,$itemName) {
  return site_url().'/wp-content/uploads/'.$itemType.'/'.$itemName;
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

?>
