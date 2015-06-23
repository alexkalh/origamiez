jQuery(document).ready(function($) {
    'use strict';

    Origamier.initMainMenu();

    Origamier.initCarouselPostRelated();        

    Origamier.initResponsive();

    Origamier.initWooCommerceGallery();    
});

jQuery(window).load(function($) {
    'use strict';

    Origamier.initImageEffect();

    Origamier.initMobileMenu();

    Origamier.initLighboxEffect();

    Origamier.initFlickFeed();

    Origamier.initTooltip();  
});


var Origamier = {
    
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
                speed: 'fast',
                speedOut: 'fast'
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
                args.items = 4;
                args.itemsDesktop = [1199, 4];
                args.itemsDesktopSmall = [979, 4];
                args.itemsTablet = [768, 3];
                args.itemsTabletSmall = [640, 2];
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
    initFlickFeed: function() {
        var flickrs = jQuery('.origamiez-flickrfeed');
        if (0 < flickrs.length) {           
            jQuery.each(flickrs, function(index, item) {
                var wrap = jQuery(this).find('.origamiez-flickrfeed-list');
                var id = wrap.data('id');
                var limit = parseInt(wrap.data('limit'));

                wrap.jflickrfeed({
                    qstrings: {
                        id: id
                    },
                    limit: (limit > 0) ? limit : 20,
                    itemTemplate:
                            '<div class="origamiez-flickr-image col-xs-4">' +
                            '<a target="_blank" href="{{link}}" class="origamiez-image-liquid" title="{{title}}">' +
                            '<img src="{{image_m}}" class="img-responsive">' +
                            '</a>' +
                            '</div>'
                }, function(data) {
                    jQuery(this).find('.origamiez-image-liquid').imgLiquid();
                });
            });           
        }
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
            var gallery   = jQuery('#origamiez-post-wrap .gallery');
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
    initWooCommerceGallery: function(){
        var gallery = jQuery('.origamiez-woo-commerce-gallery');
        if(gallery.length > 0){

            var sync_main = gallery.find('.slider-main');
            var sync_nav  = gallery.find('.slider-nav .owl-carousel');

            sync_main.owlCarousel({
                singleItem: true,
                navigation: false,
                pagination: false,
                slideSpeed: 700,
                autoPlay: false,
                transitionStyle: "fade",
                responsiveRefreshRate : 200,
                afterAction : function(el){
                    var index = this.currentItem;
                                           
                    sync_nav.find(".owl-item")
                      .removeClass("synced")
                      .eq(index)
                      .addClass("synced");

                    if(sync_nav.data("owlCarousel") !== undefined){

                        var sync_navvisible = sync_nav.data("owlCarousel").owl.visibleItems;                            
                        var found = false;

                        for(var i in sync_navvisible){
                          if(index === sync_navvisible[i]){
                            var found = true;
                          }
                        }

                        if(found===false){
                            if(index > sync_navvisible[sync_navvisible.length - 1]){
                                sync_nav.trigger("owl.goTo", index - sync_navvisible.length+2);
                            }else{
                            if(index - 1 === -1){
                                index = 0;
                            }
                                sync_nav.trigger("owl.goTo", index);
                            }
                        } else if(index === sync_navvisible[sync_navvisible.length-1]){
                            sync_nav.trigger("owl.goTo", sync_navvisible[1]);
                        } else if(index === sync_navvisible[0]){
                            sync_nav.trigger("owl.goTo", index - 1);
                        }
                    }
                }
            });

            var args = {
                items: 3,
                navigation: false,
                pagination: false,
                slideSpeed: 700,
                autoPlay: false,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3],
                itemsTablet: [768, 2],
                itemsTabletSmall: [640, 2],
                responsiveRefreshRate : 100,
                afterInit : function(el){
                    el.find(".owl-item").eq(0).addClass("synced");
                }
            };

            if (jQuery('body').hasClass('origamiez-layout-full-width')) {
                args.items = 4;
                args.itemsDesktop = [1199, 4];
                args.itemsDesktopSmall = [979, 4];
                args.itemsTablet = [768, 3];
                args.itemsTabletSmall = [640, 2];
            }

            sync_nav.owlCarousel(args);

            sync_nav.on("click", ".owl-item", function(e){
                e.preventDefault();

                var index = jQuery(this).data("owlItem");
                sync_main.trigger("owl.goTo", index);
            });
        }
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
