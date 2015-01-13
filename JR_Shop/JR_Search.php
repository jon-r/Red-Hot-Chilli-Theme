<?php

/*
SEARCH:
  > semi inteligent search input, but fairly vague output if the smart keywords arent triggered
    > the triggers are loose guides, prefer that they are skipped unless 90% likely to be what the customer is looking for.
    > mainly helps with common multi word phrases, that an A OR B would break on ("three phase", "blue seal" "oven range")

  > An RHC number points at the specific item
  > stainless steel keywords from the options file point at a search for stainless tables/sinks/etc
  > category keywords point to that category;
  > major brand keywords point to the "filtered by brand"
  > other common phrases will be combined as single strings
  > everything else will be a generic search for "A" OR "B" of whats been typed. */

function JR_Shop_Search($searchRaw) {

}


?>
