<?php

/*
Setting up url_rewrite names. The ones that arent automagically made by wordpress
*/

function jrx_page($pgtype) {
	$pageNum = [
		'grp' =>	'24',
		'cat' =>	'16',
		'item' =>	'21',
		'srch' =>	'30'
	];
	return $pageNum[$pgtype];
}

function set_permalinks() {

  $permalinks = [
    //depts
    '^brands/?'             => jrx_page(grp),
    '^departments/([^/]*)/?' => jrx_page(grp),
    //cats
    '^special-offers/?'         => jrx_page(cat),
    '^sold/?'                   => jrx_page(cat),
    '^coming-Soon/?'            => jrx_page(cat),
    '^new-items/?'              => jrx_page(cat),
    '^products/([^/]*)/?'       => jrx_page(cat),
    '^brand/([^/]*)/?'          => jrx_page(cat),
    '^search-results/([^/]*)/?' => jrx_page(cat),
    //items
    '^rhc/([^/]*)/?'  => jrx_page(item),
    '^rhcs/([^/]*)/?' => jrx_page(item)
  ];

  foreach ($permalinks as $find => $replace) {
    add_rewrite_rule($find, 'index.php?page_id='.$replace, 'top');
  }

}
add_action('init', 'set_permalinks');
?>
