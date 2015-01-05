jQuery(document).ready(function($) {
    CTUI.initColorPicker();    
});

jQuery(document).ajaxSuccess(function(e, xhr, settings) {
    jQuery.each(settings.data.split('&'), function(index, item) {
        var temp = item.split('=');
        if ('action' === temp[0]) {
            if ('save-widget' === temp[1]) {
                CTUI.initColorPicker();
            }
        }
    });
});

var CTUI = {
    initColorPicker: function() {
        var colours = jQuery('.ct-colorpicker');
        if (colours.length > 0) {
            jQuery.each(colours, function(index, item) {
                if (!jQuery(this).parents('#available-widgets').length > 0) {
                    if (!jQuery(this).hasClass('wp-color-picker')) {
                        jQuery(this).wpColorPicker({
                            defaultColor: false,
                            hide: true,
                            palettes: true
                        });
                    }
                }
            });
        }
    }
};

var CTWidget = {
    openBonusOptions: function(event, obj) {
        var wrap = obj.parents('.ct-widget-bonus-control');
        var section = wrap.find('.ct-widget-bonus-inner');
        if (obj.is(':checked')) {
            section.slideDown();
        } else {
            section.slideUp();
        }
    }
};