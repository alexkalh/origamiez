<?php
$is_display_top_bar          = (int)get_theme_mod('is_display_top_bar', 1);
$is_display_top_social_links = (int)get_theme_mod('is_display_top_social_links', 1);

if($is_display_top_bar):	
	$size_of_top_bar_col_left = $is_display_top_social_links ? 'col-sm-8' : 'col-sm-12';
?>

<div id="origamiez-top-bar">
	
	<div id="origamiez-top-bar-inner"
		class="<?php echo esc_attr(origamiez_get_wrap_classes()); ?> clearfix">
		
		<div class="row">
						
        <?php        
        if (has_nav_menu('top-nav')) {            
        	?>
        	<div class="origamiez-top-bar-col-left col-xs-12 <?php echo esc_attr($size_of_top_bar_col_left); ?>">
        	<?php
          wp_nav_menu(
            array(
								'theme_location'  => 'top-nav',
								'container'       => 'nav',
								'container_id'    => 'top-nav',
								'container_class' => 'clearfix',
								'menu_id'         => 'top-menu',
								'menu_class'      => 'clearfix'
            )
          ); 
          ?>
          </div>
          <?php           
        }
        ?> 					
			


			<?php 
			if($is_display_top_social_links): 
				$size_of_top_bar_col_right = has_nav_menu('top-nav') ? 'col-sm-4' : 'col-sm-12';
				?>
				<div class="origamiez-top-bar-col-right col-xs-12 <?php echo esc_attr($size_of_top_bar_col_right); ?>">
					<?php
		        $socials = origamiez_get_socials();
		        if (!empty($socials)):
		          ?>
		            <div id="top-social-link-inner" class="clearfix">
		                <?php
		                foreach($socials as $social_slug => $social):
		                    $url   = get_theme_mod("{$social_slug}_url", '');
		                    $color = get_theme_mod("{$social_slug}_color", $social['color']);

		                    if($url):
		                        $style = '';
		                        if ($color) {
		                            $style = "color: {$color};";
		                        }

		                        if ('fa fa-rss' == $social['icon'] && empty($url)){
		                            $url = get_bloginfo('rss2_url');
		                        }
		                        ?>
		                        <a href="<?php echo esc_url($url); ?>" 
		                            data-placement="bottom"  
		                            data-toggle="tooltip" 
		                            title="<?php echo esc_attr($social['label']);?>" 
		                            rel="nofollow" 
		                            target="_blank" 
		                            class="origamiez-tooltip social-link social-link-first" 
		                            style="<?php echo esc_attr($style);?>">
		                            <span class="<?php echo esc_attr($social['icon']); ?>"></span>
		                        </a>
		                        <?php
		                    endif;
		                endforeach;
		              ?>
		            </div>
	          <?php
		        endif;
					?>
				</div>
			<?php endif; ?>

		</div>

	</div>

</div>

<?php
endif;