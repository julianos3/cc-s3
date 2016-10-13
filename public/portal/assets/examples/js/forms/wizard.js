/*!
 * remark (http://getbootstrapadmin.com/remark)
 * Copyright 2016 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */
(function(document, window, $) {
  'use strict';

  var Site = window.Site;

  $(document).ready(function($) {
    Site.run();
  });

  // Example Wizard Form
  // -------------------
  (function() {
    // set up formvalidation
    $('#accountForm').formValidation({
      framework: 'bootstrap',
      fields: {
        zip_code: {
          validators: {
            notEmpty: {
              message: 'The zip code is required'
            }
          }
        }
      }
    });

    // init the wizard
    var defaults = $.components.getDefaults("wizard");
    var options = $.extend(true, {}, defaults, {
      buttonsAppendTo: '.panel-body'
    });

    var wizard = $("#registerForm").wizard(options).data('wizard');

    // setup validator
    // http://formvalidation.io/api/#is-valid

    wizard.get("#addressCondominium").setValidator(function() {
      var fv = $("#accountForm").data('formValidation');
      fv.validate();

      if (!fv.isValid()) {
        return false;
      }

      alert('ajax verificando se condominio existe');
      return true;
    });


  })();

})(document, window, jQuery);
