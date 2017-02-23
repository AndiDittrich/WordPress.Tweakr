<?php
/**
     Contextual Help Screen
     Version: 1.0
     Author: Andi Dittrich
     Author URI: http://andidittrich.de
     Plugin URI: http://andidittrich.de/go/tweakr
     License: MIT X11-License
    
     Copyright (c) 2014-2017, Andi Dittrich
    
     Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
    
     The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    
     THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
namespace Tweakr;

class ContextualHelp{
    
    public function __construct($settingsUtil){
    }

    /**
     * Setup Help Screen
     */
    public function contextualHelp(){
        // load screen
        $screen = get_current_screen();
    
        // shortcode help
        $screen->add_help_tab(array(
                'id' => 'cryptex_ch_shortcode',
                'title'    => __('Shortcodes'),
                'callback' => array($this, 'shortcode')
        ));
        $screen->add_help_tab(array(
                'id' => 'cryptex_ch_shortcodeoptions',
                'title'    => __('Shortcode-Options'),
                'callback' => array($this, 'shortcodeoptions')
        ));
        
        // theme/php
        $screen->add_help_tab(array(
                'id' => 'cryptex_ch_themephp',
                'title'    => __('Theme/PHP'),
                'callback' => array($this, 'themephp')
        ));
        
        // sidebar
        $screen->set_help_sidebar(file_get_contents(TWEAKR_PLUGIN_PATH.'/views/help/'.'sidebar.en_EN.html'));
    }
    
    public function shortcode(){
        include(TWEAKR_PLUGIN_PATH.'/views/help/'.'shortcodes.en_EN.phtml');
    }
    
    public function shortcodeoptions(){
        include(TWEAKR_PLUGIN_PATH.'/views/help/'.'shortcode-options.en_EN.phtml');
    }
    
    public function themephp(){
        include(TWEAKR_PLUGIN_PATH.'/views/help/'.'themephp.en_EN.phtml');
    }
    
    
}