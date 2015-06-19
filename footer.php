    <footer class="primary-footer" role="contentinfo">

      <?php include( 'page-blocks/footer-bar.php') ?>

    </footer>
  <?php // all js scripts are loaded in library/bones.php ?>
  <?php wp_footer(); ?>

  </body>

</html>

<?php if (is_front_page()) { include('page-blocks/cache-bottom.php'); } ?>
