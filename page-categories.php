<?php
/* Template Name: Filtered Items Page
*
* Listing all items sorted by Filter
*/
?>

<!-------header---------------------------------------------------------->
<?php get_header(); ?>

<section >
<!-------banner + nav---------------------------------------------------------->
these to go into menu <br>
  <a href="?page_id=16&new=1&pg=1" >NEW Items</a> <a href="?page_id=16&soon=1&pg=1" >Coming Soon</a>
  <br>
  <a href="?page_id=16&sold=1&pg=1" >Recently Sold</a> <a href="?page_id=16&all=1&pg=1" >All Items</a>
  <?php var_dump($_GET)?>

  <?php echo site_url() ?>
<!-------content---------------------------------------------------------->
  <?php include( "JR_Shop-elements/items-list.php"); ?>

</section>

<?php get_footer(); ?>
