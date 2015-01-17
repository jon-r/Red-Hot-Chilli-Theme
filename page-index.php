<?php
/* Template Name: Front Page
*
* This is your custom page template. You can create as many of these as you need.
* Simply name is "page-whatever.php" and in add the "Template Name" title at the
* top, the same way it is here.
*
* When you create your page, you can just select the template and viola, you have
* a custom page template to call your very own. Your mother would be so proud.
*
* For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<!-------header---------------------------------------------------------->

<?php get_header(); ?>

<?php include( "sidebar-left.php"); ?>
<!--  change from sidebar to topbar. leaving here so i dont forget -->

<section>

  <article>
    <div>
      banner here
    </div>
  </article>

  <article>
    <?php foreach($groupsList as $x => $group) {
            $link = http_build_query(['g' => $group]);
            echo '<a href="?page_id=24&'.$link.'" >';
            echo '<h2>'.$group.'</h2>';
            echo '</a>';
            echo '<ul>';
            $categoriesListFiltered = array_filter ($categoriesList, isGroup($group));

            foreach ($categoriesListFiltered as $category) {
                $link = http_build_query(['cat' => $category[Name]]);
                echo '<li>'.var_dump($category).'</li>' ;
            }
            echo '</ul>';
        }?>
  </article>

</section>

<?php get_footer(); ?>
