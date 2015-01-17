          <footer role="contentinfo">

            <div id="inner-footer" >

              <nav role="navigation">
                <?php wp_nav_menu(array(
                'container' => '',                              // remove nav container
                'container_class' => '',         // class of container (should you choose to use it)
                'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
                'menu_class' => '',            // adding custom nav class
                'theme_location' => 'footer-links',             // where it's located in the theme
                'before' => '',                                 // before the menu
                'after' => '',                                  // after the menu
                'link_before' => '',                            // before each link
                'link_after' => '',                             // after each link
                'depth' => 0,                                   // limit the depth of the nav
                'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
                )); ?>
              </nav>

              <p >&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>

            </div>

          </footer>

      </div>

    <?php // all js scripts are loaded in library/bones.php ?>
    <?php wp_footer(); ?>

  </body>

</html> <!-- end of site. what a ride! -->
