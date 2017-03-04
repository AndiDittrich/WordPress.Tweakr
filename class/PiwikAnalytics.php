<?php

namespace Tweakr;

use \Tweakr\skltn\ResourceManager as ResourceManager;
use \Tweakr\skltn\HtmlUtil as HtmlUtil;

class PiwikAnalytics{

    // add piwik analytics tracking code
    public static function init($settingsManager){
        // get siteid + host
        $piwikHost = $settingsManager->getOption('piwik-analytics-host');
        $piwikSiteID = $settingsManager->getOption('piwik-analytics-siteid');

        // valid host ?
        if (filter_var($piwikHost, FILTER_VALIDATE_URL) === false){
            return;
        }

        // valid site-id ?
        if ($piwikSiteID < 1){
            return;
        }

        // piwik params
        $params = array();

        // page view tracking
        $params[] = array('trackPageView');

        // link tracking
        $params[] = array('enableLinkTracking');

        // tracker id
        $params[] = array('setSiteId', $piwikSiteID);

        // get minified tracking code
        $code = file_get_contents(TWEAKR_PLUGIN_PATH . '/resources/analytics/piwik-analytics.min.js');

        // strip closing bracket
        $code = substr($code, 0, -2);

        // add params
        $code .= ',\'' . esc_js(trailingslashit($piwikHost)) . '\',' . json_encode($params) . ');';

        // enqueue code (printed within wp_footer)
        ResourceManager::enqueueDynamicScript($code);
    }

    // display user profile (render as html)
    public static function optButtonShortcode($attb = array()){

        // set defaults
        $attb = shortcode_atts( array(
            'in' => 'Disable Piwik Analytics',
            'out' => 'Piwik Analytics has been disabled!',
        ), $attb );

        // enabled or disabled ? visual user feedback
        return HtmlUtil::generateTag('button', array(
            'name' => 'tweakr-piwik-optout',
            'id' => 'tweakr-piwik-optout',
            'type' => 'button',
            'value' => '1',
            'data-text-disabled' => $attb['out'],
        ), true, $attb['in']);
    }
}

