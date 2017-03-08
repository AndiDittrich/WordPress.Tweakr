<?php

namespace Tweakr;

use \Tweakr\skltn\ResourceManager as ResourceManager;
use \Tweakr\skltn\HtmlUtil as HtmlUtil;

class PiwikAnalytics{

    // the current page title
    private $_currentPageTitle;

    // plugin options
    private $_settingsManager;

    // add piwik analytics tracking code
    public function __construct($settingsManager){
        // store settings manager instance
        $this->_settingsManager = $settingsManager;

        // late init to retrieve page related infos like the title
        add_filter('wp_enqueue_scripts', array($this, 'init'));
    }

    private function getDocumentTitle(){
        // temporary title
        $documentTitle = 'Unknown';

        // extractor function
        $extractor = function($parts) use (&$documentTitle){
            if (isset($parts['title'])){
                $documentTitle = $parts['title'];
            }
            return $parts;
        };

        // add filter to retrieve the page title
        add_filter('document_title_parts', $extractor);

        // trigger title generation
        wp_get_document_title();

        // remove filter
        remove_filter('document_title_parts', $extractor);

        // return result
        return $documentTitle;
    }

    public function init(){
        // get siteid + host
        $piwikHost = $this->_settingsManager->getOption('piwik-analytics-host');
        $piwikSiteID = $this->_settingsManager->getOption('piwik-analytics-siteid');

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

        // tracker id
        $params[] = array('setSiteId', $piwikSiteID);

        // subdomain tracking ?
        if ($this->_settingsManager->getOption('piwik-analytics-subdomain-tracking')){
            // set cookie domain to *.<your_wp_host>
            $params[] = array('setCookieDomain', '*.' . parse_url(get_site_url(), PHP_URL_HOST));
        }

        // client side do not track
        if ($this->_settingsManager->getOption('piwik-analytics-dnt')){
            $params[] = array(true, 'setDoNotTrack', 'true');
        }

        // use Simple page titles without blog name ?
        if ($this->_settingsManager->getOption('pwiki-analytics-simple-pagetitle')){
            // prepend domain ?
            if ($this->_settingsManager->getOption('piwik-analytics-prepend-domain')){
                // set the document title to <domain>/<title>
                $params[] = array('setDocumentTitle', $_SERVER['HTTP_HOST'] .  '/' . $this->getDocumentTitle());
            
            // use raw pagetitle
            }else{
                $params[] = array('setDocumentTitle', $this->getDocumentTitle());
            }
        }else{
            // prepend domain ?
            if ($this->_settingsManager->getOption('piwik-analytics-prepend-domain')){
                // set the document title to <domain>/<title>
                $params[] = array(true, 'setDocumentTitle', 'document.domain + "/" + document.title');
            }
        }

        // page view tracking
        $params[] = array('trackPageView');

        // link tracking
        $params[] = array('enableLinkTracking');

        // get minified tracking code
        $code = file_get_contents(TWEAKR_PLUGIN_PATH . '/resources/analytics/piwik-analytics.min.js');

        // strip closing bracket
        $code = substr($code, 0, -2);

        // encode params
        // json_encode is much more easier but doesnt allow us to use js code as param
        $encodedParams = array_map(function($p){
            // raw js code used ?
            if ($p[0] === true && count($p) == 3){
                return '[\'' . esc_js($p[1]) . '\',' .  $p[2] . ']';

            // string !
            }else if (count($p)==2){
                return '[\'' . esc_js($p[0]) . '\',\'' .  esc_js($p[1]) . '\']';

            // singular param
            }else{
                return '[\'' . esc_js($p[0]) . '\']';
            }

        }, $params);

        // add params
        $code .= ',\'' . esc_js(trailingslashit($piwikHost)) . '\',[' . implode(',', $encodedParams) . ']);';

        // enqueue code (printed within wp_footer)
        ResourceManager::enqueueDynamicScript($code);
    }

    // display opt-out button
    public function optButtonShortcode($attb = array()){

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

