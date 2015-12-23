jQuery(document).ready(function($) {
    'use strict';

    Origamier.initMainMenu();

    Origamier.initCarouselPostRelated();        

    Origamier.initResponsive();

    Origamier.initCarouselPostsSlider();

    Origamier.convertFlatMenuToDropdown();

    Origamier.fixGalleryPopupMissingTitle();    
});

jQuery(window).load(function($) {
    'use strict';

    Origamier.initImageEffect();

    Origamier.initMobileMenu();

    Origamier.initLighboxEffect();

    Origamier.initTooltip();

    Origamier.matchHeight();
});


var Origamier = {
    matchHeight: function(){
        sb_body   = jQuery('#origamiez-body-inner');        
        sb_body.find('.origamiez-size-01').matchHeight();
        sb_body.find('.origamiez-size-03').matchHeight();
        sb_body.find('.origamiez-size-04').matchHeight();
    },
    fixGalleryPopupMissingTitle: function(){
        items = jQuery('.gallery-item');

        if(items.length){
            jQuery.each(items, function() {
                caption = jQuery.trim(jQuery(this).find('.gallery-caption').html());
                if(caption != undefined){
                    jQuery(this).find('img').attr('title', caption);
                }
            });
        }


    },
    initCarouselPostsSlider: function() {
        var carousels = jQuery('.origamiez-widget-posts-slider .owl-carousel');
        if (0 < carousels.length) {            
            jQuery.each(carousels, function() {
                var owl = jQuery(this);
                owl.owlCarousel({
                    singleItem: true,
                    navigation: false,
                    pagination: true,
                    slideSpeed: 700,
                    autoPlay: 5000,
                    transitionStyle: "fade"                    
                });
            });            
        }
    },    
    initTooltip: function(){
        var tooltips = jQuery('.origamiez-tooltip');
        if(0 < tooltips.length){
            tooltips.tooltip();
        }
    },
    initMainMenu: function() {
        if (1 === jQuery('#main-menu').length) {
            jQuery('#main-menu').superfish({
                cssArrows: false,
                delay: 0,
                speed: 500,
                speedOut: 300,
                animation: {opacity: 'show', marginTop: 0},
                animationOut: {opacity: 'hide', marginTop: 40},
                disableHI:  true
            });
        }
    },    
    initResponsive: function() {
        jQuery("#origamiez-post-wrap, .post, .origamiez-widget-content").fitVids();
    },
    initCarouselPostRelated: function() {
        var post_related = jQuery('#origamiez-post-related .owl-carousel');
        if (0 < post_related.length) {            
            var args = {
                items: 3,
                navigation: false,
                pagination: false,
                slideSpeed: 700,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3],
                itemsTablet: [768, 2],
                itemsTabletSmall: [640, 2]
            };

            if (jQuery('body').hasClass('origamiez-layout-full-width')) {
                args.items             = 4;
                args.itemsDesktop      = [1199, 4];
                args.itemsDesktopSmall = [979, 4];
                args.itemsTablet       = [768, 3];
                args.itemsTabletSmall  = [640, 2];
            }

            post_related.owlCarousel(args);

            var widget = post_related.parents('.widget');
            widget.find('.fa-angle-left').click(function() {
                post_related.trigger('owl.prev');
            });
            widget.find('.fa-angle-right').click(function() {
                post_related.trigger('owl.next');
            });

            var figure = post_related.find('figure');

            figure.hover(function() {
                var figcaption = jQuery(this).find('figcaption');
                figcaption.stop().transition({bottom: 15});
            });

            figure.mouseleave(function() {
                var figcaption = jQuery(this).find('figcaption');
                figcaption.stop().transition({bottom: 0});
            });
        }
    },
    initMobileMenu: function() {        
        jQuery.slidebars({
            siteClose: true,
            disableOver: 799,
            hideControlClasses: true,
            scrollLock: true
        });

        jQuery('#mobile-menu').navgoco({
            caretHtml: '<span class="origamiez-mobile-caret fa fa-chevron-circle-down"></span>',
            accordion: false,
            openClass: 'open',
            save: true,
            slide: {
                duration: 400,
                easing: 'swing'
            }
        });    
    },
    initImageEffect: function() {
        var images = jQuery(".image-effect, .image-overlay");
        if (0 < images.length) {
            
            jQuery('.image-effect').hover(function() {
                jQuery(this).stop().transition({scale: [1.1, 1.1]});
            });
            jQuery('.image-effect').mouseleave(function() {
                jQuery(this).stop().transition({scale: [1.0, 1.0]});
            });

            jQuery(".image-overlay").hover(function() {
                if (OrigamierUtil.getViewportWidth() >= 768) {
                    jQuery(this).find('.overlay').stop().transition({opacity: 1});
                    jQuery(this).find('.fa').stop().css('marginLeft', '-22.5px').css('left', '50%').transition({opacity: 1});
                    jQuery(this).find('.overlay-link').stop().css('marginRight', '-22.5px').css('right', '50%').transition({opacity: 1});
                }
            });
            jQuery(".image-overlay").mouseleave(function() {
                if (OrigamierUtil.getViewportWidth() >= 768) {
                    jQuery(this).find('.overlay').stop().transition({opacity: [0]});
                    jQuery(this).find('.fa').stop().transition({left: '100%', marginLeft: 0});
                    jQuery(this).find('.overlay-link').stop().transition({right: '100%', marginRight: 0});
                }
            });
            
        }
    },
    initLighboxEffect: function() {
        if('1' == origamiez_vars.config.is_enable_lightbox){
            var blogposts = jQuery('#origamiez-blogposts .entry-thumb');
            
            var gallery   = {};
            if('1' == origamiez_vars.config.is_use_gallery_popup){
                gallery = jQuery('#origamiez-post-wrap .gallery');
            }            

            var photos    = jQuery('.origamiez-widget-posts-by-photos .origamiez-photos-wrap');
            var media     = jQuery('.poptrox_lightbox');

            if (0 < blogposts.length || 0 < gallery.length || 0 < photos.length || 0 < media.length) {
               
                var args = {
                    baseZIndex: 10001,
                    useBodyOverflow: false,
                    usePopupEasyClose: false,
                    overlayColor: '#1f2328',
                    overlayOpacity: 0.65,
                    usePopupDefaultStyling: false,
                    usePopupCaption: true,
                    popupLoaderText: '',
                    usePopupNav: false,                    
                    popupBlankCaptionText: false
                };

                var args_hidePopupNav = args;
                args_hidePopupNav.usePopupNav = false;

                if (0 < blogposts.length) {
                    blogposts.poptrox(args_hidePopupNav);
                }

                if (0 < media.length) {
                    media.poptrox(args_hidePopupNav);
                }

                var args_usePopupNav = args;
                args_usePopupNav.usePopupNav = true;

                if (0 < gallery.length) {
                    gallery.poptrox(args_usePopupNav);
                }

                if (0 < photos.length) {
                    photos.poptrox(args_usePopupNav);
                }

            }
        }
    },
    convertFlatMenuToDropdown: function() {
        if('1' == origamiez_vars.config.is_enable_convert_flat_menus){
            if ((jQuery('#top-nav').length)) {
              Origamier.createMobileMenu(jQuery('#top-nav'), 'top-mobile-menu', 'show-only-screen-and-max-width-639');
            }

            if ((jQuery('#bottom-nav').length)) {
              Origamier.createMobileMenu(jQuery('#bottom-nav'), 'bottom-mobile-menu', 'show-only-screen-and-max-width-639');
            }
        }
    },    
    createMobileMenu: function(menu_id, mobile_menu_id, mobile_menu_class) {
        jQuery('<select />').appendTo(menu_id);
        jQuery(menu_id).find('select').first().attr('id', mobile_menu_id).attr('class', mobile_menu_class);
        jQuery(menu_id).find('a').each(function() {
          var depth, el, i, selected, space;
          el = jQuery(this);
          selected = '';
          if (el.parent().hasClass('current-menu-item') === true) {
            selected = 'selected=\'selected\'';
          }
          depth = el.parents('ul').size();
          space = '';
          if (depth > 1) {
            i = 1;
            while (i < depth) {
              space += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
              i++;
            }
          }
          jQuery('<option ' + selected + ' value=\'' + el.attr('href') + '\'>' + space + el.text() + '</option>').appendTo(jQuery(menu_id).find('select').first());
        });
        jQuery(menu_id).find('select').first().change(function() {
          window.location = jQuery(this).find('option:selected').val();
        });
    }    
};

var OrigamierUtil = {
    getViewport: function(w) {
        w = w || window;
        if (w.innerWidth !== null)
            return {w: w.innerWidth, h: w.innerHeight};
        var d = w.document;
        if (document.compatMode === "CSS1Compat")
            return {w: d.documentElement.clientWidth,
                h: d.documentElement.clientHeight};
        return {w: d.body.clientWidth, h: d.body.clientHeight};
    },
    getViewportWidth: function(w) {
        viewport = OrigamierUtil.getViewport(w);
        return viewport.w;
    },
    getViewportHeight: function(w) {
        viewport = OrigamierUtil.getViewport(w);
        return viewport.h;
    }
};
