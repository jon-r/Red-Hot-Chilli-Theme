<?php
//setting page numbers between different copies of the site(local/live). development only for now
function jr_page($pgtype) {
	$pageNum = [
		'grp' =>	'24',
		'cat' =>	'16',
		'item' =>	'21',
		'srch' =>	'30'
	];
	return $pageNum[$pgtype];
}

?>
