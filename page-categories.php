<?php
/* Template Name: Filtered Items Page
*
* Listing all items sorted by Filter
*/
?>

<!-------header---------------------------------------------------------->
<?php get_header(); ?>
<?php $safeArr = jr_validate_category_params($_GET); ?>


<!-------banner + nav---------------------------------------------------------->
these to go into menu <br>


<section>


  <?php include( "JR_Shop-elements/items-list.php"); ?>

</section>

<?php get_footer(); ?>
