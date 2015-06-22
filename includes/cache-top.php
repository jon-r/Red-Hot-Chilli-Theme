<?php
global $cachefile;
$cachefile = 'cached-files/index'.date('M-d-Y').'.php';
    $cachetime = 604800;

    if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
      readfile($cachefile);
      exit;
    }
    echo 'Cached:'.$cachefile;
    ob_start();
?>
