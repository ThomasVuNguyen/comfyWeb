<?php
/**
 * Nexter Customizer Options Css
 *
 * @package	Nexter
 * @since	1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Nexter Theme Dynamic CSS
 */
if (!class_exists('Nexter_Dynamic_Css')) {

    class Nexter_Dynamic_Css {
        
        public static function render_theme_css( $theme_css = Null ) {
            
            $dynamic_css = $parse_css = $parse_tablet_css = $parse_mobile_css = '';
            
            $theme_css = apply_filters( 'nxt_render_theme_css', $theme_css );
           
            foreach($theme_css as $key => $value){
            
                if($key==='tablet' && !empty($value)){
                
                    $parse_tablet_css .= nexter_generate_css($value, '', '1024');   //tablet max=1024
                    
                }else if($key==='mobile' && !empty($value)){
                
                    $parse_mobile_css .= nexter_generate_css($value, '', '767'); //mobile max=767
                    
                }else if($key==='container_d' && !empty($value)){
                
                    $parse_css .= nexter_generate_css($value, '1200');  //desktop container min=1200
                    
                }else if($key==='container_t' && !empty($value)){
                
                    $parse_css .= nexter_generate_css($value,'768', '1199');  //tablet container max=768px
                    
                }else if($key==='container_m' && !empty($value)){
                
                    $parse_css .= nexter_generate_css($value,'', '767');  //mobile container max=576px
                    
                }else if(!empty($value)){
                
                    $parse_css .= nexter_generate_css($value);  //Normal/default Css
                    
                }
            }
             
            $parse_css = $parse_css . $parse_tablet_css . $parse_mobile_css;
           
            $dynamic_css = $parse_css;
            //Minify css
            $dynamic_css = nexter_minify_css_generate($dynamic_css);
			
            return apply_filters('nexter_theme_dynamic_css', $dynamic_css);
        }
        
    }
}