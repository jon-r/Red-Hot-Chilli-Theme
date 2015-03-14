          <footer class="primary-footer" role="contentinfo">

            <div class="container" >

              <?php wp_nav_menu(array(
              'container' => '',                              // remove nav container
              'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
              'menu_class' => 'menu-footer',                  // adding custom nav class
              'theme_location' => 'footer-links',             // where it's located in the theme
              'fallback_cb' => ''                             // fallback function
              )); ?>

              <p class="copyright" >&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></p>

            </div>

          </footer>

      </div>

    <?php // all js scripts are loaded in library/bones.php ?>
    <?php wp_footer(); ?>

  </body>

</html>
