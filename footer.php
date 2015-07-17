    <footer class="primary-footer" role="contentinfo">

      <?php echo do_shortcode( "[jr-shop id='footer-bar' cached=true]"); ?>

    </footer>
  <?php // all js scripts are loaded in library/bones.php ?>
  <?php wp_footer(); ?>

  <?php // form validation included only where needed ?>
  <?php if (isset($GLOBALS['hasMailForm']) ) {
  echo '<script type="text/javascript" src="'
    .get_template_directory_uri().'/library/js/validate.min.js" ></script>' ;
  }?>

  </body>

</html>
