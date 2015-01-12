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


<section id="main">

<!-------banner + nav---------------------------------------------------------->
	<?php include( "sidebar-left.php"); ?>


	<article id="index-banner" >
		<div id="index-banner-inner" class="cf">
			banner here
		</div>
	</article>
<!-------content---------------------------------------------------------->

	<article id="Groups-List" >
		<?php foreach($groupsList as $url => $group) {
				echo '<a href="?page_id=24&g='.$url.'" >';
				echo '<h2>'.$group.'</h2>';
				echo '</a>';
				echo '<ul>';

				$categoriesListFiltered = array_filter ($categoriesList, isGroup($url));

				foreach ($categoriesListFiltered as $category) {
					echo isGroup($category,$url) ?
						'<li><a href="?page_id=16&q='.$category[RefName].'&pg=1" >'.$category[Name].'</a></li>' : null;
				}
				echo '</ul>';
			}?>

	</article>

</section>

<?php get_footer(); ?>
