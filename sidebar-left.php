	<div id="sidebar1" class=" m-all t-1of4 d-1of7" role="complementary">

		<?php dynamic_sidebar( 'sidebar1' ); ?>

		<?php foreach($groupsList as $url => $group) {
				echo '<a href="?page_id=24&g='.$url.'" >';
				echo '<h3>'.$group.'</h3>';
				echo '</a>';
				echo '<ul>';

				$categoriesListFiltered = array_filter ($categoriesList, isGroup($url));

				foreach ($categoriesListFiltered as $category) {
					$link = http_build_query(['cat' => $category[Name]]);
					echo '<a href="?page_id=16&'.$link.'&pg=1" >'.$category[Name].'</a><br>' ;
				}
			}?>

	</div>
