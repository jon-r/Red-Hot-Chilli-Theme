<?php
global $itemCountMax, $itemCountMin, $rhcTwitterLink, $rhcFacebookLink, $rhcLinkedinLink,
  $link_allCategories, $link_allItems, $link_soldItems, $link_newItems, $link_soonItems;

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

//link to "special" pages - those not from database
$link_allCategories = site_url('departments/all/');
$link_allItems = site_url('products/all/');
$link_soldItems = site_url('/sold/');
$link_newItems = site_url('/new-items/');
$link_soonItems = site_url('/coming-soon/');


/*Category Text \
\ phrases for the category page */

function jr_category_info($catType) {
  $categoryFilterArr = [
    'New'   => 'Fresh off the workshop floor, this equipment is cleaned and ready to go.<br>
                Enquire quickly, stock can go as soon as it comes in!',
    'Soon'  => 'Stock that has just entered our workshops.<br>
                If interested, call '.$rhcTel.' today and grab a bargain as soon as its ready.',
    'Sold'  => 'Don\'t worry if you were to late to get the item you wanted, there may be another soming soon <br>
                call '.$rhcTel.' today and reserve what you need before it goes again!',
    'Sale'  =>  'Surplus stock, or equipment with a few extra dents.<br>
                 We make sure everything works fully before going online, so get it cheap today!',
    'Search' => 'Still can\'t find what you were looking for? call '.$rhcTel.' today and see if we can help',
    'All'   =>  'We buy and sell new items each week, and can\'t always keep the new site up to date.<br>
                 If there is anything in particular you are looking for, feel free to call '.$rhcTel.' and we\'ll see what we can find.'
  ];
  return $categoryFilterArr[$catType];
}

// img location
function imgSrcRoot($itemType,$itemName,$filetype) {
  return 'images/'.$itemType.'/'.$itemName.'.'.$filetype;
}


//Image sizes for generated. would need to wipe gallery-thumb/gallery-tile folders if these are changed
function imgSize($size) {
  $sizeArr = [
    'thumb' => 150,
    'tile'  => 480
  ];
  return $sizeArr[$size];
}



?>
