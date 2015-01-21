<?php
/* Template Name: Item Page
*
* detail on single item
*/
?>

<!-------header---------------------------------------------------------->

<?php get_header(); ?>
<?php $safeArr = jr_validate_item_params($_GET); ?>

<section>

  <?php include( "JR_Shop-elements/menu-breadcrumbs.php"); ?>

  <?php include( "JR_Shop-elements/items-full.php"); ?>

</section>

<?php get_footer(); ?>
