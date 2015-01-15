<?php
/* Template Name: Filtered Items Page
*
* Listing all items sorted by Filter
*
*/
?>

<!-------header---------------------------------------------------------->

<?php get_header(); ?>



<section id="main">
<!-------banner + nav---------------------------------------------------------->
	<?php include( "sidebar-left.php"); ?>
	<!-- probably change from sidebar to topbar -->
<!-------content---------------------------------------------------------->
	<article id="products-list" >
    <h1>Title PH</h1>
		<a href="?page_id=16&new=1&pg=1" >NEW</a> <a href="?page_id=16&soon=1&pg=1" >Soon</a><br>
		<a href="?page_id=16&sold=1&pg=1" >Sold 30days</a> <a href="?page_id=16&all=1&pg=1" >All</a>

	<?php


//echo $filter." = ".$filterSearch."<br>";

//echo http_build_query(['search' => ['gas','oven']]);
//echo var_dump($_GET["search"]);

//$query = filterPage($filter, $filterCategories);

echo "<hr>";

//var_dump ($brandsListFull);

var_dump( categoryFilter(
	$fLatest = 		$_GET["new"],
	$fAll =				$_GET["all"],
	$fSoon =			$_GET["soon"],
	$fRecentSold =$_GET["sold"],
	$rawSearch = 	$_GET["search"],
	$rawBrand	= 	$_GET["brand"],
	$rawCategory =$_GET["cat"]
));

/*
$getCategoryRef = $_GET["q"];
		$pgCategory = $wpdb->get_row("SELECT * FROM `rhc_categories` WHERE `RefName` LIKE '$getCategory' ", ARRAY_A);


	$pgItemsCategory = str_replace($_GET["q"], $categoriesList[Name], $categoriesList[RefName]);
	print_r ($categoriesList[Name]);

	echo "<h1>".$pgItemsCategory."</h1>";

	$itemsListFiltered = array_filter ($itemsList, isCategory($pgItemsCategory));

	foreach ($itemsListFiltered as $item) :
		$jrShopLite = rhcCompileLite($item);

	?>

		<a href="<?php echo $jrShopLite[weblink] ?>">
			<h3><?php echo $jrShopLite[name] ?></h3>
			<img width="200px" src="<?php echo $jrShopLite[imgFirst] ?>" />
		</a>

	<?php  endforeach; */  ?>


	</article>


</section>





<?php get_footer(); ?>
