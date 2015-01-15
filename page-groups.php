<?php
/* Template Name: Groups Page
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



<section id="main">
<!-------banner + nav---------------------------------------------------------->
	<?php include( "sidebar-left.php"); ?>
<!-------content---------------------------------------------------------->
	<article id="category-list" >

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
