<?php
/* Template Name: Groups Page
*
* page for grouped categories.
*/
?>

<!-------header---------------------------------------------------------->

<?php get_header(); ?>

<section>
<!-------banner + nav---------------------------------------------------------->
  <?php include( "sidebar-left.php"); ?>
<!-------content---------------------------------------------------------->
  <article>

  <?php

    $group = $_GET["g"];

    echo "<h1>".strtr($_GET["g"], $groupsList)."</h1>";

    $categoriesListFiltered = array_filter ($categoriesList, isGroup($group));

    foreach ($categoriesListFiltered as $category) {
        $link = http_build_query(['cat' => $category[Name]]);
        echo '<img src="../redhotchilli/wp-content/uploads/thumbnails/'.$category[RefName].'.jpg" />' ;
        echo '<a href="?page_id=16&'.$link.'&pg=1" >'.$category[Name].'</a><br>' ;
    }

  ?>

  </article>

</section>





<?php get_footer(); ?>
