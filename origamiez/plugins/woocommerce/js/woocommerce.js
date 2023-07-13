'use strict';

jQuery(document).ready(function($) {
    OrigamierWoocommerce.stylingControl();
});

jQuery(window).load(function($) {

});


var OrigamierWoocommerce = {
    stylingControl: function() {
    		jQuery(".quantity input.input-text[type=number]").attr('type', 'text');

        jQuery(".quantity input.input-text[type=text]").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'fa fa-plus',
            verticaldownclass: 'fa fa-minus'
        });
    }
}