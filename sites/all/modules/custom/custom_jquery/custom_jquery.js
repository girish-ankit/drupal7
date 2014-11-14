(function($) {

    Drupal.behaviors.customJquey = {
        attach: function(context, settings) {

            /** This function runs many times ***/

            $('h3.slider-trigger-1').click(function() {
                $('.slider-1').slideToggle();
            });
            /** /This function runs many times ***/

            /** This function runs only one time ***/

            $('h3.slider-trigger-2').once('myslider', function() {
                $('h3.slider-trigger-2').click(function() {
                    $('.slider-2').slideToggle();
                });
            });
            /** This function runs only one time ***/

        }

    };

}(jQuery));