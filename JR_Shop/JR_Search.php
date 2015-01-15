<?php

/*
SEARCH:
  > semi inteligent search input, but fairly vague output if the smart keywords arent triggered
    > the triggers are loose guides, prefer that they are skipped unless 90% likely to be what the customer is looking for.
    > mainly helps with common multi word phrases, that an A OR B would break on ("three phase", "blue seal" "oven range")

Priority:
 	0 > major
 	1 > major brand keywords point to the "filtered by brand" (matching unique brands in network db);
	2 > category keywords point to that category (matching to category_db);
	3 > power (matching keywords_db)
	3 > stainless steel keywords from keywords_db point at a search for stainless tables/sinks/etc (matching keywords_db)
  4 > everything else will be a generic search for "A" OR "B" of whats been typed.

*/


function jr_smart_search($searchTerm) {

	$urlStart = 'http://jon-pc/redhotchilli/?page_id=16&';

//RHCs first
	if (stripos($searchTerm, "rhc") === 0) {
		$urlStart = 'http://jon-pc/redhotchilli/?page_id=21&';
		$urlMid = 'r='.str_replace('rhc', '', $searchTerm);
//} elseif () {

	} else {
		$urlMid = http_build_query(['search' => $searchTerm]);
	}
	//$searchSTR
	return wp_redirect( $urlStart.$urlMid  , 301 );
}

?>
