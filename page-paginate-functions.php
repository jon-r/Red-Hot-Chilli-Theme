<?php

function getPaginating($itemsList) {
	$itemCount = count($itemsList);



	$listSlice = array_slice($itemsList, $offset, $length);
}

$pageLength = 20;							//items per page. maybe adjust later.
$pageTotal = floor($itemCount / $pageLength); //number of pages
$pageCurrent = $_GET["pg"]; 				//page number we're on

$url = str_replace("&pg=".$pgCurrent , "&pg=" , $_SERVER["REQUEST_URI"]); //get the page category, blank page number





	$offset = $pgLength * ($page[Current] - 1); //where to start each page



}

//WP PAgination. need to add html styling to this. also no need to include defaults
echo paginate_links( [
	'base'         => $url.'%#%',
	'format'       => '%#%',
	'total'        => $pgTotal,
	'current'      => $pgCurrent,
	'show_all'     => False,
	'end_size'     => 1,
	'mid_size'     => 2,
	'prev_next'    => True,
	'prev_text'    => __('« Previous'),
	'next_text'    => __('Next »'),
	'type'         => 'plain',
	'add_args'     => False,
	'add_fragment' => '',
	'before_page_number' => '',
	'after_page_number' => ''
] );


/*

$getCategory = $_GET["q"];

$compiled = rhcCompileLite($products);

$pgCategory = $wpdb->get_row("SELECT *
								FROM rhc_categories
								WHERE `RefName` LIKE '$getCategory'");

$productCount = $wpdb->get_var("SELECT COUNT(*)
										FROM `networked db`
										WHERE `LiveonRHC` = 1 ");	//number of items TODO add category filter (above)

$pgTotal = floor($productCount / $pgLength); //number of pages


//slicing the whole list for this page
$productList = $wpdb->get_results("SELECT *
									FROM `networked db`
									WHERE `LiveonRHC` = 1
									LIMIT $pgLength OFFSET $pgOffset ", ARRAY_A);
									*/


?>
