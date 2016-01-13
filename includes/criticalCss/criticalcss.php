<?php /*

TO DO = date check; proper crediting

  inline critical css loader. for faster loading front page, and to keep google happy

  to update on modified css or index:
    1) requires gulp + critical. assumes if you've got this far you've done an 'npm
      install' which will include it.
    2) save a html copy of the index page, put into the criticalcss folder
    3) run 'gulp critical'

  NOTES:
  Since I can realistically assume any css edits will NOT be added with gulp. It'll
  disable itself if the modified dates of 'STYLE.MIN.CSS' and 'CRITICAL.CSS' are
  different, and if the critical stuff doesnt exist for whatever reason.

  Also required a copy of the index.html in the critical folder. just go to the index
  online, ctrl-s, save it into the CRITICALCSS folder
*/



$criticalStyle = file_get_contents(__DIR__.'/critical.css') ;
$baseStyle = get_stylesheet_directory_uri() . '/library/css/style.min.css#' . wp_get_theme()->get( 'Version' );;
?>
<style type="text/css"><?php echo $criticalStyle ?></style>
<script>
  function loadCSS(e,t,n){"use strict";var i=window.document.createElement("link");var o=t||window.document.getElementsByTagName("script")[0];i.rel="stylesheet";i.href=e;i.media="only x";o.parentNode.insertBefore(i,o);setTimeout(function(){i.media=n||"all"})}
  loadCSS('<?php echo $baseStyle ?>');
</script>
<noscript>
  <link rel="stylesheet" href="<?php echo $baseStyle ?>">
</noscript>
