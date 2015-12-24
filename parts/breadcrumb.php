<?php

if(1 === (int)get_theme_mod('is_display_breadcrumb', 1)){	
	do_action('origamiez_print_breadcrumb');
}