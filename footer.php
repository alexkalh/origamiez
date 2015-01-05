</div> <!-- end #ct-body > container > #ct-boby-inner -->
</div> <!-- end #ct-body-->
<footer id="ct-footer" class="clearfix">                
    
    <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') || is_active_sidebar('footer-5')): ?>
        <div id="ct-footer-sidebars" class="clearfix">        
            <div id="ct-footer-sidebars-inner" class="<?php ct_get_wrap_classes(); ?> clearfix">
                <div class="row clearfix">                    
                    <div id="ct-footer-right" class="col-md-8 col-sm-12 col-xs-12 widget-area" role="complementary">    
                        <div class="row clearfix">
                            <?php get_sidebar('footer-1'); ?>                            
                            <?php get_sidebar('footer-2'); ?>
                            <?php get_sidebar('footer-3'); ?>
                            <?php get_sidebar('footer-4'); ?>                
                        </div>
                    </div>
                    <?php get_sidebar('footer-5'); ?>
                </div>
            </div>   
        </div>
    <?php endif; ?>

    <?php $footer_information = ot_get_option('footer_information', false);?>
    <div id="ct-footer-end" class="clearfix">                                        
        <div class="<?php ct_get_wrap_classes(); ?> clearfix">
            <?php
            #FOOTER MENU
            if (has_nav_menu('footer-nav')) {
                wp_nav_menu(
                        array(
                            'theme_location' => 'footer-nav',
                            'container' => 'nav',
                            'container_id' => 'bottom-nav',
                            'container_class' => 'pull-right',
                            'menu_id' => 'bottom-menu',
                            'menu_class' => 'clearfix'
                        )
                );
            }
            ?>
            <?php if ($footer_information): ?>
                <div id="ct-footer-copyright" class="pull-left">
                    <?php echo $footer_information; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>          
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
