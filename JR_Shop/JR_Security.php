<?php

/* SECURITY:
  > Since the Back-End is Based on in house PCs, theres a fairly limited amount that the customer can access.
  > no personal details are to be keeped on internet databases
  > Light security whitlelist sanitises the input to prevent injection just in case.
*/

//whiteLists for the security.
//currently selects only letters, numbers, and the symbols '" /+-
$searchFilter = "['\" /+-]|\w";

//validates categories, makes sure exists
function jr_validate_category() {

};

//

?>
