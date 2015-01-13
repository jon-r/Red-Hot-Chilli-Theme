<?php

/*
Plugin Name: E-Catalogue for Red Hot Chilli Products.
Plugin URI: www.just-temp.com
Description: GET_PRODUCTS = Takes the data directly from the database, filtered and sorted based on user input or pages. OUTPUT = Converts data into user friendly chunks of output. Includes filters, sorts, search, etc. Smart image hunting, assuming the image sync as been used correctly. Light security whitelist. SEARCH: semi intelegent. An RHC number points at the specific item; stainless steel keywords from the options file point at a search for stainless tables/sinks/etc; category keywords point to that category; everything else will be a generic search for "A" OR "B" of whats been typed. Light security whitlelist sanitises the input to prevent injection.
Version: 0.1
Author: Jon Richards
Author URI: www.just-temp.com
*/

global $wpdb, $categoriesList, $itemsList, $groupsURLs, $groupsList, $itemCount, $itemCountMin, $categoriesStainless;

/* Settings \
\ This should be the only section to that needs editing  */

//These are the main categories.
$groupsList = [
//'website-URL'		=>		'Category'
	'cook-heat' 		=> 		'Cooking & Hot Storage',
	'food-prep'			=> 		'Food Preparation & Cleaning',
	'furnishings' 	=> 		'Furniture & Front of House',
	'chilled'				=> 		'Refrigeration & Cold Storage',
	'stainless-steel' => 	'Stainless Steel Fabrications',
	'specialist'		=> 		'Specialist Cooking'
];

//how many items per page before pagination kicks in. Also limits the "new items" page.
$itemCount 		= 		20;

//How many items before the "try elsewhere" kicks in. NYI
$itemCountMin	=		4;

//stainless category mini-filter. all the categories that point at the stainless steel part of the database
$categoriesStainless = [
	'Sinks',
	'Worktops',
	'Shelving & Gantries'
];

//whiteLists for the security.
//currently selects only letters, numbers, and the symbols '" /+-
$searchFilter	=	"['\" /+-]|\w";


/* GETS \
\ Links to the function pages.*/

include('JR_Get_Products.php');
include('JR_Search.php');
include('JR_Output.php');

//perhaps a widget? or have functions generate the php so only function needed

