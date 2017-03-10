<?php
/*  AUTO GENERATED FILE - DO NOT EDIT !!
    WP-SKELEKTON | MIT X11 License | https://github.com/AndiDittrich/WP-Skeleton
    ------------------------------------
    Generate Dynamic CSS Files
*/
namespace Tweakr\skltn;

class CssBuilder{
    
    // cached css ruleset
    private $_buffer = array();

    // cached raw css
    private $_rawBuffer = '';
    
    public function __construct(){
    }

    // add new ruleset
    public function add($selector, $rules = array()){
        $this->_buffer[$selector] = $rules;
    }

    // add raw css
    public function addRaw($css){
        $this->_rawBuffer .= "\n" . $css;
    }

    // render ruleset
    public function render(){
        // local output buffer
        $css = '/* Tweakr Dynamical Generated Stylesheet - DO NOT EDIT */';

        // get rulesets
        foreach ($this->_buffer as $selector => $rules){
            // new ruleset
            $css .= "\n" . $selector . '{';

            // process rules
            foreach ($rules as $prop => $value){
                $css .= $prop . ':' . $value . ';';
            }

            // close ruleset
            $css .= '}';
        }

        // add raw css
        $css .= $this->_rawBuffer;

        return $css;
    }
    
}