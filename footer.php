    <footer class="primary-footer" role="contentinfo">

      <?php echo do_shortcode( "[jr-shop id='footer-bar' cached=true]"); ?>

    </footer>
  <?php // all js scripts are loaded in library/bones.php ?>
  <?php wp_footer(); ?>
<?php if (isset($GLOBALS['hasMailForm']) ) : ?>
  <script type="text/javascript"
          src="<?php echo plugins_url('jr-shop/functions/js/validate.min.js') ?>" ></script>
  <script type="text/javascript">
  var validator = new FormValidator(
    'contact', [{
      name: 'name',
      display: 'required',
      rules: 'required'
    }, {
      name: 'email',
      rules: 'required'|'valid_email',
      depends: function() {
          return Math.random() > .5;
      }
    }, {
      name: 'tel',
      display: 'required',
      rules: 'required'|'alpha_dash'
    }, {
      name: 'Postcode',
      desplay: 'required',
      rules: 'required'|'alpha_numeric'
    },],
    function(errors, event) {
      if (errors.length > 0) {
          // Show the errors
        for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
          errorString += errors[i].message + '<br />';
        }
        console.log(errorString);
      }
    });
</script>
<?php endif ?>

  </body>

</html>
