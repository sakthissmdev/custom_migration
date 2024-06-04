/**
 * This can be achieved in CSS itself by using hover.
 */
(function ($, Drupal, once) {
    Drupal.behaviors.customJqueryBehavior = {
      attach: function (context, settings) {
        once('customJqueryBehavior', 'table td', context).forEach(function (element) {
          $(element).on('mouseenter', function() {
            $(this).css('background-color', '#b96229');
          }).on('mouseleave', function() {
            $(this).css('background-color', '#2980b9');
          });
        });
      }
    };
  })(jQuery, Drupal, once);
  