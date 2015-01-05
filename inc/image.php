<?php

function ct_get_image_sizes(){
	$sizes = array();
      
    $sizes['posts-slide-m'] = array( 'width' => 750, 'height' => 400, 'crop' => true);
    $sizes['posts-slide-metro'] = array( 'width' => 497, 'height' => 475, 'crop' => true);
    $sizes['square-m'] = array( 'width' => 300, 'height' => 300, 'crop' => true);
    $sizes['square-vertical-m'] = array( 'width' => 340, 'height' => 360, 'crop' => true);
    $sizes['square-xs'] = array( 'width' => 55, 'height' => 55, 'crop' => true);
    $sizes['square-s'] = array( 'width' => 70, 'height' => 70, 'crop' => true);
    $sizes['blog-m'] = array( 'width' => 374, 'height' => 209, 'crop' => true);
    $sizes['blog-sm'] = array( 'width' => 374, 'height' => 280, 'crop' => true);
    $sizes['gallery-m'] = array( 'width' => 534, 'height' => 421, 'crop' => true);
    $sizes['gallery-s'] = array( 'width' => 257, 'height' => 196, 'crop' => true);
    $sizes['lightbox-full'] = array( 'width' => 960, 'height' => null, 'crop' => false);
    $sizes['posts-slide-m-mobile'] = array( 'width' => 480, 'height' => 400, 'crop' => true);
    $sizes['lightbox-full-mobile'] = array( 'width' => 640, 'height' => null, 'crop' => false); 

    
    $sizes['shop_thumbnail'] = array( 'width' => 60, 'height' => 60, 'crop' => true); 
    $sizes['shop_catalog'] = array( 'width' => 275, 'height' => 325, 'crop' => true); 
    $sizes['product-catalog-m'] = array( 'width' => 275, 'height' => 400, 'crop' => true); 
    $sizes['woo-commerce-gallery'] = array( 'width' => 400, 'height' => 400, 'crop' => true); 
    $sizes['woo-commerce-gallery-zoom'] = array( 'width' => 400, 'height' => 400, 'crop' => true);     
    $sizes['woo-commerce-gallery-nav'] = array( 'width' => 160, 'height' => 120, 'crop' => true);

    return apply_filters('ct_get_image_sizes', $sizes);
}

function ct_get_image_src($post_id = 0, $size = 'thumbnail') {
    $thumb = get_the_post_thumbnail($post_id, $size);
    if (!empty($thumb)) {
        $_thumb = array();
        $regex = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
        preg_match($regex, $thumb, $_thumb);
        $thumb = $_thumb[2];
    }
    return $thumb;
}


function ct_bfi_thumb($image, $size = NULL, $width = NULL, $height = NULL, $crop = true) {
    $src = NULL;

    if (!empty($image)) {
        if (empty($width) && empty($height) && !empty($size)) {
            $sizes = ct_get_image_sizes();

            if (isset($sizes[$size])) {
                $width = $sizes[$size]['width'];
                $height = $sizes[$size]['height'];
                $crop = $sizes[$size]['crop'];
            }
        }

        $src = bfi_thumb($image, array('width' => $width, 'height' => $height, 'crop' => $crop));
    }  

    return apply_filters('ct_bfi_thumb', $src, $image, $size, $width, $height, $crop);
}


function ct_post_bfi_thumb($post_id = 0, $size = NULL, $width = NULL, $height = NULL, $crop = true) {
    $src = NULL;    

    if (isset($post_id) && !empty($post_id) && has_post_thumbnail($post_id)) {       
        if (empty($src)) {
            $image = ct_get_image_src($post_id, 'full');           
            $src = ct_bfi_thumb($image, $size, $width, $height, $crop);
        }
    }

    return apply_filters('ct_post_bfi_thumb', $src, $post_id, $size, $width, $height, $crop);
}


function ct_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr){
	$sizes = ct_get_image_sizes();
  	if(isset($sizes[$size])){  		
  		$image = ct_post_bfi_thumb($post_id, $size);
  		$html = "<img src='{$image}'";

  		if(!empty($attr)){
	  		foreach ($attr as $key => $value) { 
	  			$html.= sprintf(" %s='%s'", $key, $value);
  			}
  		}

  		$html.= '/>';
  	}
  
  	return $html;
}