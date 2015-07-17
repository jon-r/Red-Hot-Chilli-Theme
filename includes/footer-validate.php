
  <script type="text/javascript">
    var $form = $('.js_contact_form');
  var validator = new FormValidator(
    'contact_form', [{
      name: 'name',
      display: 'Name',
      rules: 'required'
    }, {
      name: 'email',
      display: 'Email',
      rules: 'valid_email|required',
      depends: function () {
        return Math.random() > .5;
      }
    }, {
      name: 'tel',
      display: 'Phone Number',
      rules: 'alpha_dash|required'
    }, {
      name: 'postcode',
      display: 'Postcode',
      rules: 'alpha_numeric|required'
    }],
    function (errors, event) {
      event.preventDefault();
      var errorString = "";
      var errorLength = errors.length;
      if (errorLength > 0) {
        for (var i = 0; i < errorLength; i++) {
          //errorString += errors[i].message;
          $form.find(errors[i].element).addClass('error');
        }

      } else {
        //errorString = "success";
      }
      console.log(errors);
    });



</script>
