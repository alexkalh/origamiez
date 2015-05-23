#Origamiez - Wordpress Theme

If you is planning to start an online blog website, Origamiez is a Blog WordPress theme which is designed for online blog sites. 

This Origamiez WordPress theme was designed and coded by COLOURS THEME

Origamiez comes with a simple and clean layout but professional and nice look. Theme offers lots of features as unlimited color schemes, sidebars, Google Fonts, rich formats, top banners. Fully responsive, this Origamiez WordPress Theme has really great look on any device. With its professional layout, it's easy to customize and use.


##1. Theme Features

- Fully responsive, HTML5 & CSS3
- Support bbPress
- Unlimited Colors with 14 Color Picker
- Unlimited Font with Google Fonts
- Bootstrap 3
- Font Awesome 4
- 2 Blog Layout
- 5 Widgets
- Advance Theme Options with Option Tree Framework
- Ready for translations .mo/.po files are included

##2. Plugins Compatiable
- Forum: [bbPress](https://wordpress.org/plugins/bbpress/)
- Contact Form: [Contact Form 7](https://wordpress.org/plugins/contact-form-7/)
- Multi language: [Polylang](https://wordpress.org/plugins/polylang/)

##3. Support
- [Always free with support forum](http://colourstheme.com/forums/forum/wordpress/theme/origamiez/)


##4. Versions

- ####1.1.0 (2015.05.23)
    - fix: add "sanitize_callback" for each setting
    - edit: add prefix "origmiez" for custom image sizes
    - edit: remove section "banner" - replace by add_theme_support('custom-header')
    - edit: remove section "background" - replace by add_theme_support('custom-background')
    - edit: some js and css
    - remove: background slideshow with jquery.vegas.js


- ####1.0.9 (2015.05.22)    
    - remove: OptionTree plugin
    - remove: BFI_Thumb library    
    - remove: favicon & apple-icon    
    - remove: small thumbnail for single-post    
    - apply: Theme Customization API to build theme-options    

- ####1.0.8 (2015.05.11)    
    - edit:  escape home_url() with esc_url
    
- ####1.0.7 (2015.05.11)
    - remove: filter "shortcode_atts_gallery"
    - remove: filter "widget_text"    
    - remove: filter "user_contactmethods"
    - remove: featured "view-counter", because "this is plugin territory"
    - remove: theme-option "taxonomy_excerpt_words_limit"
    - remove: protocol from google font enqueues    
    - fix: re-check all code and escape data with esc_attr, esc_url,..
    - replace: language file '.po' by '.pot'
    - add: file "editor-style.css" with pre-defined typography

- ####1.0.6 (2015.05.04)
    - fix: with fresh install, theme can't load theme-options custom fields.
    - fix: crash html when widget-title missing, or empty.

- ####1.0.5 (2015.04.30)
    - delete lines 925-928 in theme-options.php follow guide http://antsanchez.com/using-ot-framework-wordpress-theme/

- ####1.0.4 (2015.04.28)
    - change: prefix of function, constant, variable to theme-slug (origamiez)
    - add: text-domain "origamiez" to file style.css

- ####1.0.3 (2015.04.27)
    - edit: change mode of "Option Tree", from "plugin" to "theme"
    - edit: re-check all code with warning "theme security vulnerability"
    - edit: using esc_attr, esc_url, esc_textarea, wp_kses to print data
    - fix: some css code about widget newsletter with right-sidebar

- ####1.0.2 (2015.03.15)
    - fix: breadcumb Home label invalid
    - fix: add border-bottom for bottom sidebar.        

- ####1.0.1 (2015.02.15)
    - edit: remove border-bottom of widget title in bottom sidebar.
    - fix: before_widget missing .origamiez-widget-content (if widget title is empty)



- ####1.0.0 (2015.01.01) : Release first version


##5. Sources and Credits

###Images
Images are used in the screenshot are from public domain http://pixabay.com, and distributed under the terms of the Creative Commons CC0 1.0 Universal Public Domain Dedication (http://creativecommons.org/publicdomain/zero/1.0/deed.en)

- http://pixabay.com/en/home-office-workstation-office-336373
- http://pixabay.com/en/home-office-workstation-office-336378
- http://pixabay.com/en/chair-computer-desktop-mac-macbook-388739

###Stylesheet & Scripts
See headers of files for further details.

- ####Bootstrap: v3.1.1
    - http://getbootstrap.com
    - Copyright 2011-2014 Twitter, Inc.
    - Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)

- ####Font Awesome License
    - Code License - http://fontawesome.io 
    - License: MIT License
    - License URI: http://opensource.org/licenses/mit-license.html
    - Copyright: Dave Gandy, http://fontawesome.io

- ####hoverIntent
    - http://cherne.net/brian/resources/jquery.hoverIntent.html
    - Copyright 2007, 2013 Brian Cherne
    - MIT license

- ####FitVids 1.1
    - Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
    - Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
    - Released under the WTFPL license - http://sam.zoy.org/wtfpl/

- ####FlickrFeed
    - Copyright (C) 2009 Joel Sutherland
    - http://www.newmediacampaigns.com/page/jquery-flickr-plugin
    - Licenced under the MIT license

- ####IMG Liquid
    - lejandro Emparan (karacas) / @krc_ale
    - https://github.com/karacas/imgLiquid
    - Dual licensed under the MIT and GPL licenses

- ####jQuery Navgoco Menus
    - https://github.com/tefra/navgoco
    - Copyright (c) 2014 Chris T (@tefra)
    - BSD - https://github.com/tefra/navgoco/blob/master/LICENSE-BSD

- ####poptrox
    - jquery.poptrox.js
    - n33 | n33.co | MIT licensed

- ####jQuery Transit
    - CSS3 transitions and transformations
    - 2011-2012 Rico Sta. Cruz
    - MIT Licensed.
    - http://github.com/rstacruz/jquery.transit

- ####Vegas
    - Fullscreen Backgrounds and Slideshows with jQuery.
    - Licensed under the MIT license.
    - http://vegas.jaysalvat.com/
    - Copyright (C) 2010-2013 Jay Salvat

- ####Modernizr
    - MIT & BSD
    - Build: http://modernizr.com/download/#-fontface-backgroundsize-borderradius-boxshadow-flexbox-flexboxlegacy-multiplebgs-opacity-rgba-textshadow-cssanimations-csscolumns-generatedcontent-cssgradients-cssreflections-csstransforms-csstransforms3d-csstransitions-shiv-mq-cssclasses-prefixed-teststyles-testprop-testallprops-prefixes-domprefixes-load

- ####jQuery OwlCarousel v1.3.2
    - Copyright (c) 2013 Bartosz Wojciechowski
    - http://www.owlgraphic.com/owlcarousel/
    - Licensed under MIT

##6. Limitation
Footer menu does not support multi level dropdown menu

Thanks!
ColoursTheme