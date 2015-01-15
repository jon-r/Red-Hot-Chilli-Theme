<?php

/*
E-Catalogue Functions Core for Red Hot Chilli Products.
Author: Jon Richards - Jan 2015

----FEATURES----

SETTINGS: The options hardcoded into the php.
  > The things tweaked the most (items, categorys) are in the database, easily edited.
  > This is the stuff that should be fine-tuned to cover most tweaks (hopefully).

CATEGORIES: Takes the data directly from the database,
  > Filtered and sorted based on user input or pages.

OUTPUT:
  > Converts data into user friendly chunks of output.
  > Includes filters, sorts, etc.
  > Smart image hunting, assuming the images have been uploaded correctly.

SEARCH:
  > semi inteligent search input, but fairly vague output if the smart keywords arent triggered
    > the triggers are loose guides, prefer that they are skipped unless 90% likely to be what the customer is looking for.
    > mainly helps with common multi word phrases, that an A OR B would break on ("three phase", "blue seal" "oven range")

  > An RHC number points at the specific item
  > stainless steel keywords from the options file point at a search for stainless tables/sinks/etc
  > category keywords point to that category;
  > major brand keywords point to the "filtered by brand"
  > other common phrases will be combined as single strings
  > everything else will be a generic search for "A" OR "B" of whats been typed.

SECURITY:
  > Since the Back-End is Based on in house PCs, theres a fairly limited amount that the customer can access.
  > Light security whitlelist sanitises the input to prevent injection just in case.

*/





/* GETS \
\ Links to the function pages and arrays.*/
include('JR_Global_Variables.php');

include('JR_Security.php');

include('JR_Search.php');

include('JR_Categories.php');

include('JR_Output.php');

//perhaps a widget? or have functions generate the php so only function needed

