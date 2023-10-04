<?php
/**
 * Nexter Gutenberg Editor Dynamic Css
 *
 * @package	Nexter
 * @since	1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Nexter Gutenberg Editor Dynamic CSS
 */
if (!class_exists('Nexter_Gutenberg_Dynamic_Css')) {

    class Nexter_Gutenberg_Dynamic_Css {
        
        /**
         * Return Generate dynamic CSS Output
         */
        public static function render_theme_css( $theme_css = Null ) {
            
            $dynamic_css = $parse_css = $parse_tablet_css = $parse_mobile_css = '';
            
            $theme_css = apply_filters( 'nxt_gutenberg_render_theme_css', $theme_css );
            
            foreach($theme_css as $key => $value){
            
                if($key==='tablet' && !empty($value)){
                
                    $parse_tablet_css .= nexter_generate_css($value, '', '1024');   //tablet max=1024
                    
                }else if($key==='mobile' && !empty($value)){
                
                    $parse_mobile_css .= nexter_generate_css($value, '', '767'); //mobile max=767
                    
                }else if($key==='container_d' && !empty($value)){
                
                    $parse_css .= nexter_generate_css($value, '1200');  //desktop container min=1200
                    
                }else if($key==='container_t' && !empty($value)){
                
                    $parse_css .= nexter_generate_css($value, '768');  //tablet container min=768px
                    
                }else if($key==='container_m' && !empty($value)){
                
                    $parse_css .= nexter_generate_css($value, '576');  //mobile container min=576px
                    
                }else if(!empty($value)){
                
                    $parse_css .= nexter_generate_css($value);  //Normal/default Css
                    
                }
            }
            
            $parse_css = $parse_css . $parse_tablet_css . $parse_mobile_css;
            
            $dynamic_css = $parse_css;
            
            //Minify css
            $dynamic_css = nexter_minify_css_generate($dynamic_css);
            
            return apply_filters('nxt_gutenberg_dynamic_style_css', $dynamic_css);
        }
        
    }
}