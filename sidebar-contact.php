				<div id="sidebar-contact" class="sidebar m-all t-1of2 d-2of5 last-col cf" role="complementary">

					<h4>Where to find us</h4>

					<?php if ( is_active_sidebar( 'sidebar-contact' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar-contact' ); ?>

					<?php else : ?>

						<?php
							/*
							 * This content shows up if there are no widgets defined in the backend.
							*/
						?>

						<div class="no-widgets">
							<p><?php _e( 'This is a widget ready area. Add some and they will appear here.', 'bonestheme' );  ?></p>
						</div>

					<?php endif; ?>

				</div>
