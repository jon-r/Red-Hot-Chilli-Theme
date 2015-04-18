<?php

/*
Setting up url_rewrite names. The ones that arent automatically made by wordpress
*/

function jr_page($pgtype) {
	$pageNum = [
		'grp' =>	'24',
		'cat' =>	'16',
		'item' =>	'21',
		'srch' =>	'29'
	];
	return $pageNum[$pgtype];
}



function custom_rewrite_basic() {
  $permalinks = [
    //depts

    '^brands/?'             => jr_page(grp).'g=_brand',
    '^all/?'                => jr_page(grp).'g=_all',
    '^departments/([^/]*)/?' => jr_page(grp).'g=$matches[1]',
    //cats
    '^special-offers/?'     => jr_page(cat).'c=sale',
    '^sold/?'               => jr_page(cat).'c=sold',
    '^coming-soon/?'        => jr_page(cat).'c=soon',
    '^new-items/?'          => jr_page(cat).'c=new',
    '^products/([^/]*)/?'   => jr_page(cat).'c=$matches[1]',
    '^brand/([^/]*)/?'      => jr_page(cat).'c=brand&b=$matches[1]',
    '^search/([^/]*)/?'     => jr_page(cat).'c=search&s=$matches[1]',
    //items
    '^rhc([^/]*)-([^/]*)/?'  => jr_page(item).'r=$matches[1]&n=$matches[2]',
    '^rhcs([^/]*)-([^/]*)/?' => jr_page(item).'r=$matches[1]&n=$matches[2]&s=1'
  ];

  foreach ($permalinks as $find => $replace) {
    add_rewrite_rule($find, 'index.php?page_id='.$replace, 'top');
  }

}
add_action('init', 'custom_rewrite_basic');

?>
