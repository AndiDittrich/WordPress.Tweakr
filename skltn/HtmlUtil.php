<?php
/*  AUTO GENERATED FILE - DO NOT EDIT !!
    WP-SKELEKTON | MIT X11 License | https://github.com/AndiDittrich/WP-Skeleton
    ------------------------------------
    Generate HTML Tags with a given list of attributes as key=>value array
*/
namespace Tweakr\skltn;

class HtmlUtil{
    
    // generate a HTML tag and escape attribute/value pairs + content
    public static function generateTag($name, $htmlAttributes = array(), $selfClosing=true, $content=false){
        // generate tag start
        $html = '<'.strtolower($name);
        
        // generate html attributes
        foreach ($htmlAttributes as $key=>$value){
            $html .= ' '.esc_attr($key).'="'.esc_attr($value).'"';
        }
        
        // self closing and no content ?
        if ($selfClosing === true){

            // add content ?
            if ($content !== false){

                $html .= '>' . esc_html($content) . '</'.strtolower($name) . '>';

            // just close it
            }else{
                $html .= ' />';
            }
        }else{
            // add content ?
            if ($content !== false){
                $html .= '>' . esc_html($content);
            }else{
                $html .= '>';
            }
        }
        
        return $html;
    }
    
}