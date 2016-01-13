    <footer class="primary-footer" role="contentinfo">

      <?php echo do_shortcode( "[jr-shop id='footer-bar' cached=true]"); ?>

    </footer>
  <?php // all js scripts are loaded in library/bones.php ?>
  <?php wp_footer(); ?>
  <?php include is_front_page() ? 'includes/criticalCss/criticalcssFoot.php' : null; ?>

  </body>

</html>
