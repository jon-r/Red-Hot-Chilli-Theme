<?php
/* style for the breadcrumbs along top of page.
* based on pageID mostly, so will need fixing after proper names.
*/


/*
  [RHC ICON]          [SEARCH ]           [other links]
_________________________________________________________
[MENU BUTTON]  [ HOME > GROUP > CATEGORY > ITEM ]
                      > SPECIAL PAGE(S)
*/

$breadLinks = jr_page_crumbles ($_GET['page_id'],$safeArr);
?>

<nav>
<?php
foreach ($breadLinks as $name => $link) {
  echo ' > <a href="'.$link.'" >'.$name."</a>";
}
?>
</nav>

