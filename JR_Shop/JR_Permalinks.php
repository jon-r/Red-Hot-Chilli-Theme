<?php

/*
Setting up url_rewrite names. The ones that arent automagically made by wordpress
*/

function jr_page($pgtype) {
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
    '^brands/?'             => jr_page(grp).'&g=_brand',
    '^departments/([^/]*)/?' => jr_page(grp).'&g=$matches[1]',
    //cats
    '^special-offers/?'     => jr_page(cat).'&c=sale',
    '^sold/?'               => jr_page(cat).'&c=sold',
    '^coming-Soon/?'        => jr_page(cat).'&c=soon',
    '^new-items/?'          => jr_page(cat).'&c=new',
    '^products/([^/]*)/?'   => jr_page(cat).'&c=$matches[1]',
    '^brand/([^/]*)/?'      => jr_page(cat).'&c=brand&b=$matches[1]',
    '^search-results/([^/]*)/?'     => jr_page(cat).'&c=search&s=$matches[1]',
    //items
    '^rhc/([^/]*)/?'  => jr_page(item).'&r=$matches[1]&n=$matches[2]',
    '^rhcs/([^/]*)/?' => jr_page(item).'&r=$matches[1]&n=$matches[2]&steel=1'
  ];

  foreach ($permalinks as $find => $replace) {
    add_rewrite_rule($find, 'index.php?page_id='.$replace, 'top');
  }

}
add_action('init', 'set_permalinks');
?>
