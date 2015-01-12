<?php
// list of variables on this page so they can be used elsewhere.
global $categoriesStainless, $itemCount, $groupsList;

//These are the main categories.
$groupsList = [
//	'websiteURL'		=>		'Category'
	'cook-heat' 		=> 		'Cooking & Hot Storage',
	'food-prep'			=> 		'Food Preparation & Cleaning',
	'furnishings' 		=> 		'Furniture & Front of House',
	'chilled'			=> 		'Refrigeration & Cold Storage',
	'stainless-steel' 	=> 		'Stainless Steel Fabrications',
	'specialist'		=> 		'Specialist Cooking'
];

//stainless category mini-filter. all the categories that point at the stainless steel part of the database
$categoriesStainless = [
	'Sinks',
	'Worktops',
	'Shelving & Gantries'
];

//how many items per page before pagination kicks in.

		$itemCount 		= 		20;


?>
