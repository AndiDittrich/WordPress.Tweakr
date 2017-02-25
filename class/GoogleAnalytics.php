<?php

namespace Tweakr;

use \Tweakr\skltn\ResourceManager as ResourceManager;
use \Tweakr\skltn\HtmlUtil as HtmlUtil;

class GoogleAnalytics{

    // analytics tracking snippet
    // @see https://developers.google.com/analytics/devguides/collection/analyticsjs/
    const GA_TRACKING_CODE = "
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');";
    
    // an additional condition is added to ensure the code is NOT EXECUTED in case a opt-out cookie has been set!
    // the opt-out is done in js because of possible issues/side effects with caching plugins!!!
    const WRAPPER_PRE = "(function(b){if(document.cookie.indexOf('tweakr-analytics-optout=')==-1){";

    // in case the opt-out cookie is set, the button text is changed and the css class "tweakr-analytics-out" is added
    const WRAPPER_POST = "}else{if(!b){return;}b.innerHTML=b.getAttribute('data-text-disabled');b.className='tweakr-analytics-out'}})(document.getElementById('tweakr-analytics-optout'))";
   
    // add google analytics tracking code
    public function init($trackingID, $anonymizeIP = false){
        
        // set opt-out cookie on request - 3650 days
        if (isset($_POST) && isset($_POST['tweakr-analytics-optout'])){
            // set optout cookie
            setcookie('tweakr-analytics-optout', '1', time() + (3600*24*3650));
        }
        
        // generate init code
        $analyticsInit = array(
            "ga('create', '". esc_js($trackingID) . "', 'auto');",
        );

        // use anonymize-ip option ?
        if ($anonymizeIP){
            array_push($analyticsInit, "ga('set', 'anonymizeIp', true);");
        }

        // send page view
        array_push($analyticsInit, "ga('send', 'pageview');");

        // enqueue code (printed within wp_footer) - close conditional block
        ResourceManager::enqueueDynamicScript(self::WRAPPER_PRE . self::GA_TRACKING_CODE . implode("\n", $analyticsInit) . self::WRAPPER_POST);

        // ok!
        return true;
    }

    // display user profile (render as html)
    public function optButtonShortcode($attb = array()){

        // set defaults
        $attb = shortcode_atts( array(
            'in' => 'Disable Google Analytics',
            'out' => 'Google Analytics has been disabled!',
        ), $attb );
        
        // generate form
        $content = HtmlUtil::generateTag('form', array(
            'method' => 'post',
            'action' => $_SERVER['REQUEST_URI']
        ), false);
        
        // enabled or disabled ? visual user feedback
        $content .= HtmlUtil::generateTag('button', array(
            'name' => 'tweakr-analytics-optout',
            'id' => 'tweakr-analytics-optout',
            'type' => 'submit',
            'value' => '1',
            'data-text-disabled' => $attb['out'],
        ), true, $attb['in']);
        
        // close form tag
        return $content. '</form>';
    }
}

