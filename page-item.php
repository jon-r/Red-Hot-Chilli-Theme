<?php
/* Template Name: Item Page
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

<?php
	$itemList = $wpdb->get_row("SELECT * FROM `networked db` WHERE RHC = $_GET[r]", ARRAY_A);

	print_r($itemList);

	echo "<hr>";

	$jrShop = rhcCompile($itemList); ?>


	<h1><?php echo $jrShop[name] ?></h1>
	<h3>Ref: <?php echo $jrShop[rhc] ?></h3>

	<article>
		<img width="500px" src="<?php echo $jrShop[imgFirst] ?>" />

		<ul>
			<?php foreach ($jrShop[imgAll] as $list) {
			echo "<li><img src='".$list."' style='height:250px' /></li>";
		} ?>
		</ul>
	</article>

	<article>
		<h1><?php echo $jrShop[price] ?></h1>
		<h3><?php echo $jrShop[vatPrice] ?></h3>
		<?php if($jrShop[reduction]) {
			echo "<H3>SALE!</H3>";
			echo "<p>".$jrShop[reduction]."</p>";
		} ?>

		<?php echo $jrShop[power] ?>
		<h2><?php echo $jrShop[watt] ?></h2>

		<h1><?php echo $jrShop[brand] ?></h1>
		<h2><?php echo $jrShop[model] ?></h2>

<!--		wishlish, shopping cart buttons -->
	</article>

	<article>
		<h3>About</h3>
		<p><?php echo $jrShop[desc] ?></p>
		<h3>Specs</h3>
		<p><?php echo $jrShop[fullSizes] ?></p>
		<p><?php echo $jrShop[extra] ?></p>
		<p><?php echo $jrShop[condition] ?></p>

<!--	ask about button -->

		<p>Full Inspection at our showroom in Warrington, Cheshire available
			<br>Please contact us for a competitive delivery quote to the UK and overseas
			<br>All appliances are fully checked and tested by our engineers before going on sale</p>
	</article>

</section>



<?php get_footer(); ?>
