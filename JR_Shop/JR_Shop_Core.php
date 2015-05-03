<?php

/*
E-Catalogue Functions Core for Red Hot Chilli Products.
Author: Jon Richards - Jan 2015

----FEATURES----

Global Variables: The options hardcoded into the php.
  > The things tweaked the most (items, categorys) are in the database, easily edited.
  > This is the stuff that should be fine-tuned to cover most tweaks (hopefully).

Queries: Takes the data directly from the database,
  > Filtered and sorted based on user input or pages.

Output:
  > Converts data into user friendly chunks of output.
  > Includes filters, sorts, etc.
  > Smart image hunting, assuming the images have been uploaded correctly.

Search:
  > semi inteligent search input, but fairly vague output if the smart keywords arent triggered
    > the triggers are loose guides, prefer that they are skipped unless 90% likely to be what the customer is looking for.
  > An RHC(s) number points at the specific item
  > everything else will be a REGEX search of whats been typed, treating spaces as 'OR'

Validate:
  > Since the Back-End is Based on in house PCs, theres a fairly limited amount that the customer can access.
  > Light security whitlelist sanitises the input to prevent injection just in case.

Permalinks:
  > extending the WP rewrite rules, to include all the shop pages.
  > this ties into functions.php

*/

/* GETS \
\ Links to the function pages and arrays.*/

include('JR_Global_Variables.php');

include('JR_Validate.php');

include('JR_Search.php');

include('JR_Queries.php');

include('JR_Outputs.php');

// initial page setup in the header. this is the stuff on everypage, so can be called straight away
global $safeArr,$getGroup, $getCategory, $groupArray;

$getGroup = jrx_query_keywords('group');
$getCategory = jrx_query_categories();

foreach ($getGroup as $grp) {
  $groupArray[$grp] = groupFilter($grp);
}


//now to clean the parameter input
$safeArr = jrx_validate_urls(getUrl());


