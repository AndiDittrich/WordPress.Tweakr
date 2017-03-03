<?php

namespace Tweakr;

use \Tweakr\skltn\ResourceManager as ResourceManager;
use \Tweakr\skltn\HtmlUtil as HtmlUtil;

class GoogleAnalytics{

    // add google analytics tracking code
    public function init($trackingID, $anonymizeIP = false){
        // get minified tracking code
        $code = file_get_contents(TWEAKR_PLUGIN_PATH . '/resources/google-analytics.min.js');

        // strip closing bracket
        $code = substr($code, 0, -2);

        // add params
        $code .= ',\'' . esc_js($trackingID) . '\',' . ($anonymizeIP ? 'true' : 'false') . ');';

        // enqueue code (printed within wp_footer)
        ResourceManager::enqueueDynamicScript($code);
    }

    // display user profile (render as html)
    public function optButtonShortcode($attb = array()){

        // set defaults
        $attb = shortcode_atts( array(
            'in' => 'Disable Google Analytics',
            'out' => 'Google Analytics has been disabled!',
        ), $attb );

        // enabled or disabled ? visual user feedback
        return HtmlUtil::generateTag('button', array(
            'name' => 'tweakr-analytics-optout',
            'id' => 'tweakr-analytics-optout',
            'type' => 'button',
            'value' => '1',
            'data-text-disabled' => $attb['out'],
        ), true, $attb['in']);
    }
}

